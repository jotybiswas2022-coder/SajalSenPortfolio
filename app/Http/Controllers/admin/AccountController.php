<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $account = Account::first();
        return view('backend.account.index', compact('account'));
    }

    public function edit(): \Illuminate\View\View
    {
        $account = Account::first();
        return view('backend.account.edit', compact('account'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:255',
            'image'   => 'nullable|image|max:2048',
            'cv'      => 'nullable|mimes:pdf,doc,docx|max:5120',
            'github'  => 'nullable|url|max:500',
            'linkedin'=> 'nullable|url|max:500',
            'facebook'=> 'nullable|url|max:500',
            'instagram'=> 'nullable|url|max:500',
            'twitter' => 'nullable|url|max:500',
            'youtube'   => 'nullable|url|max:500',
            'fiverr'    => 'nullable|url|max:500',
            'upwork'    => 'nullable|url|max:500',
            'freelancer'=> 'nullable|url|max:500',
        ]);

        $account = Account::first();
        if (!$account) {
            $account = new Account();
            $account->image = ''; 
        }
        $account->name = $request->name;
        $account->phone = $request->phone;
        $account->email = $request->email;
        $account->github = $request->github;
        $account->linkedin = $request->linkedin;
        $account->facebook = $request->facebook;
        $account->instagram = $request->instagram;
        $account->twitter = $request->twitter;
        $account->youtube = $request->youtube;
        $account->fiverr = $request->fiverr;
        $account->upwork = $request->upwork;
        $account->freelancer = $request->freelancer;

        // Image upload
        if ($request->hasFile('image')) {
            if ($account->image && Storage::disk('public')->exists($account->image)) {
                Storage::disk('public')->delete($account->image);
            }
            $account->image = $request->file('image')->store('profile', 'public');
        }

        // CV upload
        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($account->cv && Storage::disk('public')->exists($account->cv)) {
                Storage::disk('public')->delete($account->cv);
            }
            $account->cv = $request->file('cv')->store('cv', 'public');
        }

        // Remove CV
        if ($request->has('remove_cv') && $request->remove_cv == '1') {
            if ($account->cv && Storage::disk('public')->exists($account->cv)) {
                Storage::disk('public')->delete($account->cv);
            }
            $account->cv = null;
        }

        $account->save();

        return redirect()->back()->with('success', 'Account updated successfully!');
    }

    public function deleteImage(): \Illuminate\Http\RedirectResponse
    {
        $account = Account::first();
        if ($account && $account->image && Storage::disk('public')->exists($account->image)) {
            Storage::disk('public')->delete($account->image);
        }
        if ($account) {
            $account->image = null;
            $account->save();
        }
        return redirect()->back()->with('success', 'Profile picture deleted successfully!');
    }
}
