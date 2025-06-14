<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $items = Price::all();
        return view('pages.prices', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);
        Price::create($data);
        return redirect()->route('dashboard')->with('status', 'Price created');
    }
}
