<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
   function index(): \Illuminate\View\View{
        $contacts = Contact::latest()->get();

        $now = Carbon::now('Asia/Dhaka');
        $stats = [
            'total'     => $contacts->count(),
            'thisWeek'  => Contact::whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count(),
            'today'     => Contact::whereDate('created_at', $now->toDateString())->count(),
        ];

        return view('backend.contact.index', compact('contacts', 'stats'));
    }
}
