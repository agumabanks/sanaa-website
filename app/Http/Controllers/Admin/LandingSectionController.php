<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = \App\Models\LandingSection::orderBy('sort_order')->get();
        return view('admin.landing-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.landing-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section_type' => 'required|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        \App\Models\LandingSection::create($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.landing-sections.index')->with('success', 'Section created successfully.');
    }

    public function edit(\App\Models\LandingSection $landingSection)
    {
        return view('admin.landing-sections.edit', ['section' => $landingSection]);
    }

    public function update(Request $request, \App\Models\LandingSection $landingSection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section_type' => 'required|string|max:255',
            'content' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $landingSection->update($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.landing-sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(\App\Models\LandingSection $landingSection)
    {
        $landingSection->delete();
        Cache::forget('landing_page_data');
        return redirect()->route('admin.landing-sections.index')->with('success', 'Section deleted successfully.');
    }

    public function toggle(\App\Models\LandingSection $landingSection)
    {
        $landingSection->update(['is_active' => !$landingSection->is_active]);
        Cache::forget('landing_page_data');

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'is_active' => $landingSection->is_active,
                'message' => 'Visibility updated'
            ]);
        }
        
        return back()->with('success', 'Section visibility toggled.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $index => $id) {
            \App\Models\LandingSection::where('id', $id)->update(['sort_order' => ($index + 1) * 10]);
        }
        Cache::forget('landing_page_data');

        return response()->json(['status' => 'success']);
    }
}
