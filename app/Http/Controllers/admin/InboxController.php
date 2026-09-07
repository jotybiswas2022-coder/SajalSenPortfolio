<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;

class InboxController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $conversations = Conversation::with('user', 'lastMessage.sender', 'gig')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('backend.inbox.index', compact('conversations'));
    }

    public function show($id): \Illuminate\View\View
    {
        $conversation = Conversation::with('messages.sender', 'user', 'gig')->findOrFail($id);
        return view('backend.inbox.show', compact('conversation'));
    }

    public function sendMessage(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $conversation = Conversation::findOrFail($id);

        $request->validate([
            'message' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if (!$request->message && !$request->hasFile('image')) {
            return back()->withErrors(['message' => 'Please enter a message or select an image.']);
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

        if (!$conversation->admin_id) {
            $conversation->update(['admin_id' => auth()->id()]);
        }

        $conversation->touch();

        return back();
    }
}
