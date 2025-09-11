<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceCommunity;
use Illuminate\Http\Request;

class CommunityController extends Controller
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
        $communities = FinanceCommunity::orderBy('sort_order')->paginate(15);

        return view('admin.finance.communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.finance.communities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'segment_name' => 'required|string|max:255',
            'needs' => 'nullable|array',
            'value_props' => 'nullable|array',
            'case_links' => 'nullable|array',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        FinanceCommunity::create($validated);

        return redirect()->route('admin.finance.communities.index')
            ->with('success', 'Community created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceCommunity $community)
    {
        return view('admin.finance.communities.show', compact('community'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceCommunity $community)
    {
        return view('admin.finance.communities.edit', compact('community'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinanceCommunity $community)
    {
        $validated = $request->validate([
            'segment_name' => 'required|string|max:255',
            'needs' => 'nullable|array',
            'value_props' => 'nullable|array',
            'case_links' => 'nullable|array',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $community->update($validated);

        return redirect()->route('admin.finance.communities.index')
            ->with('success', 'Community updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceCommunity $community)
    {
        $community->delete();

        return redirect()->route('admin.finance.communities.index')
            ->with('success', 'Community deleted successfully.');
    }
}
