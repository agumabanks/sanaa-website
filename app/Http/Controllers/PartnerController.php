<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $items = Partner::all();
        return view('pages.partners', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        Partner::create($data);
        return redirect()->route('dashboard')->with('status', 'Partner created');
    }
}
