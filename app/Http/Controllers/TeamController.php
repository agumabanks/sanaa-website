<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TeamController extends Controller
{
    public function index()
    {
        // Team size is small (<50); cache for one hour
        $members = Cache::remember('team_members', 3600, fn() => TeamMember::all());
        return view('team.index', compact('members'));
    }

    public function edit(TeamMember $member)
    {
        return view('dashboard.team-edit', compact('member'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('dashboard.team')->with('status', 'Team member created');
    }

    public function update(Request $request, TeamMember $member)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $member->update($data);

        return redirect()->route('dashboard.team')->with('status', 'Team member updated');
    }

    public function destroy(TeamMember $member)
    {
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();
        return redirect()->route('dashboard.team')->with('status', 'Team member deleted');
    }
}
