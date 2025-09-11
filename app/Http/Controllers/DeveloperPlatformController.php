<?php

namespace App\Http\Controllers;

use App\Models\DeveloperPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DeveloperPlatformController extends Controller
{
    public function index()
    {
        // Developer platforms are limited (<20); cache for 1 hour
        $items = Cache::remember('developer_platforms', 3600, fn() => DeveloperPlatform::all());
        return view('pages.developer-platforms', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        DeveloperPlatform::create($data);
        return redirect()->route('dashboard.developer-platforms')->with('status', 'Developer platform created');
    }
}
