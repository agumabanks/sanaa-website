<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    public function __construct()
    {
        $this->middleware('finance');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = FinanceTechnology::orderBy('sort_order')->paginate(15);

        return view('admin.finance.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.finance.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('finance/technologies', 'public');
        }

        FinanceTechnology::create($validated);

        return redirect()->route('admin.finance.technologies.index')
            ->with('success', 'Technology created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceTechnology $technology)
    {
        return view('admin.finance.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceTechnology $technology)
    {
        return view('admin.finance.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinanceTechnology $technology)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($technology->logo) {
                Storage::disk('public')->delete($technology->logo);
            }
            $validated['logo'] = $request->file('logo')->store('finance/technologies', 'public');
        }

        $technology->update($validated);

        return redirect()->route('admin.finance.technologies.index')
            ->with('success', 'Technology updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceTechnology $technology)
    {
        // Delete associated logo if exists
        if ($technology->logo) {
            Storage::disk('public')->delete($technology->logo);
        }

        $technology->delete();

        return redirect()->route('admin.finance.technologies.index')
            ->with('success', 'Technology deleted successfully.');
    }
}
