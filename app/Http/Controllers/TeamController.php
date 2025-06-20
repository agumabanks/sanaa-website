<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::all();
        return view('team.index', compact('members'));
    }

    public function edit(TeamMember $member)
    {
        return view('dashboard.team-edit', compact('member'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'title' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image',
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
            'name' => 'required',
            'title' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image',
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
