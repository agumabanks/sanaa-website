<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PartnerController extends Controller
{
    public function index()
    {
        // Partner list is expected to stay under 50 records so cache for an hour
        $items = Cache::remember('partners', 3600, fn() => Partner::all());
        return view('pages.partners', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        Partner::create($data);
        return redirect()->route('dashboard.partners')->with('status', 'Partner created');
    }
}
