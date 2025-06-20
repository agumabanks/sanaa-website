<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $items = Career::all();
        return view('pages.careers', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);
        Career::create($data);
        return redirect()->route('dashboard.careers')->with('status', 'Career created');
    }
}
