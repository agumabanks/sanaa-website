<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinanceTeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
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
        $members = FinanceTeamMember::orderBy('sort_order')->paginate(15);

        return view('admin.finance.team-members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.finance.team-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'headshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'socials' => 'nullable|array',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('headshot')) {
            $validated['headshot'] = $request->file('headshot')->store('finance/team', 'public');
        }

        FinanceTeamMember::create($validated);

        return redirect()->route('admin.finance.team-members.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceTeamMember $teamMember)
    {
        return view('admin.finance.team-members.show', compact('teamMember'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceTeamMember $teamMember)
    {
        return view('admin.finance.team-members.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinanceTeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'headshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'socials' => 'nullable|array',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('headshot')) {
            // Delete old headshot if exists
            if ($teamMember->headshot) {
                Storage::disk('public')->delete($teamMember->headshot);
            }
            $validated['headshot'] = $request->file('headshot')->store('finance/team', 'public');
        }

        $teamMember->update($validated);

        return redirect()->route('admin.finance.team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceTeamMember $teamMember)
    {
        // Delete associated headshot if exists
        if ($teamMember->headshot) {
            Storage::disk('public')->delete($teamMember->headshot);
        }

        $teamMember->delete();

        return redirect()->route('admin.finance.team-members.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
