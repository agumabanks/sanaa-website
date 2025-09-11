<?php

namespace App\Http\Controllers;

use App\Models\HardwareRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HardwareRentalController extends Controller
{
    public function index()
    {
        // Hardware rental catalog is small (<50); cache for 1 hour
        $items = Cache::remember('hardware_rentals', 3600, fn() => HardwareRental::all());
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
