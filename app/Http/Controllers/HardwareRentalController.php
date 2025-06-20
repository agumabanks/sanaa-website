<?php

namespace App\Http\Controllers;

use App\Models\HardwareRental;
use Illuminate\Http\Request;

class HardwareRentalController extends Controller
{
    public function index()
    {
        $items = HardwareRental::all();
        return view('pages.rent-hardware', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        HardwareRental::create($data);
        return redirect()->route('dashboard.hardware-rentals')->with('status', 'Hardware rental created');
    }
}
