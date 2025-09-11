<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        // Contact methods are few (<10); cache for 1 hour
        $items = Cache::remember('contacts', 3600, fn() => Contact::all());
        return view('pages.contact', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'nullable',
        ]);
        Contact::create($data);
        Mail::to('agumabanksibrahim@gmail.com')->send(
            new ContactMessage(
                $data['name'],
                $data['email'],
                $data['message'] ?? null
            )
        );
        return back()->with('status', 'Message sent');
    }
}
