<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

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
        return back()->with('status', 'Message sent');
    }
}
