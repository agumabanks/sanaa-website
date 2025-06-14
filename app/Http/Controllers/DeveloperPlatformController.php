<?php

namespace App\Http\Controllers;

use App\Models\DeveloperPlatform;
use Illuminate\Http\Request;

class DeveloperPlatformController extends Controller
{
    public function index()
    {
        $items = DeveloperPlatform::all();
        return view('pages.developer-platforms', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        DeveloperPlatform::create($data);
        return redirect()->route('dashboard')->with('status', 'Developer platform created');
    }
}
