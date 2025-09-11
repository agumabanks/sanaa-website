<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PartnerController extends Controller
{
    public function index()
    {
        $cacheKey = 'partners_all';
        if (Cache::has($cacheKey)) {
            Log::debug("Cache hit: {$cacheKey}");
        }

        $items = Cache::remember($cacheKey, now()->addDay(), function () use ($cacheKey) {
            Log::debug("Cache miss: {$cacheKey}");
            return Partner::all();
        });

        return view('pages.partners', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        Partner::create($data);
        Cache::forget('partners_all');
        Log::debug('Cache cleared: partners_all');

        return redirect()->route('dashboard.partners')->with('status', 'Partner created');
    }
}
