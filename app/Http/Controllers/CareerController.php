<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CareerController extends Controller
{
    public function index()
    {
        // Career postings are limited (<100); cache for 30 minutes
        $items = Cache::remember('careers', 1800, fn() => Career::all());
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
