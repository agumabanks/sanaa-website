<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PriceController extends Controller
{
    public function index()
    {
        // Pricing tiers are few (<20); cache for 1 hour
        $items = Cache::remember('prices', 3600, fn() => Price::all());
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
        return redirect()->route('dashboard.prices')->with('status', 'Price created');
    }
}
