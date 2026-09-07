<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Gig;
use Illuminate\Support\Facades\Storage;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): \Illuminate\View\View
    {
        $conversations = Conversation::where('user_id', auth()->id())
            ->with('lastMessage.sender', 'gig')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('frontend.inbox.index', compact('conversations'));
    }

    public function show($id): \Illuminate\View\View
    {
        $conversation = Conversation::where('user_id', auth()->id())
            ->with('messages.sender', 'gig')
            ->findOrFail($id);

        return view('frontend.inbox.show', compact('conversation'));
    }

    public function sendMessage(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $conversation = Conversation::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'message' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if (!$request->message && !$request->hasFile('image')) {
            return back()->withErrors(['message' => 'Please enter a message or select an image to send.']);
        }

        $data = [
            'conversation_id' => $conversation->id,
            'sender_id'       => auth()->id(),
            'message'         => $request->message,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chat-images', 'public');
        }

        Message::create($data);
        $conversation->touch();

        return back();
    }

    public function orderFromGig(Request $request, $gigId, $package): \Illuminate\Http\RedirectResponse
    {
        $gig = Gig::findOrFail($gigId);

        $packageNames = [
            'basic'   => $gig->basic_name ?: 'Basic',
            'standard' => $gig->standard_name ?: 'Standard',
            'premium'  => $gig->premium_name ?: 'Premium',
        ];

        $packagePrices = [
            'basic'   => $gig->basic_price,
            'standard' => $gig->standard_price,
            'premium'  => $gig->premium_price,
        ];

        $packageFeatures = [
            'basic'   => $gig->basic_features,
            'standard' => $gig->standard_features,
            'premium'  => $gig->premium_features,
        ];

        if (!isset($packageNames[$package])) {
            abort(404);
        }

        $subject = 'New Order: ' . $gig->title . ' - ' . $packageNames[$package];

        $conversation = Conversation::create([
            'user_id'         => auth()->id(),
            'gig_id'          => $gig->id,
            'subject'         => $subject,
            'package_name'    => $packageNames[$package],
            'package_price'   => $packagePrices[$package],
            'package_details' => $packageFeatures[$package] ?? null,
            'status'          => 'open',
        ]);

        $initialMessage = "I'd like to order the {$packageNames[$package]} package ({$packagePrices[$package]} USD) for \"{$gig->title}\". Please provide more details.";

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => auth()->id(),
            'message'         => $initialMessage,
        ]);

        return redirect()->route('inbox.show', $conversation->id);
    }
}
