<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $items = Contact::all();
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
