<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $cacheKey = 'team_members_all';
        if (Cache::has($cacheKey)) {
            Log::debug("Cache hit: {$cacheKey}");
        }

        $members = Cache::remember($cacheKey, now()->addDay(), function () use ($cacheKey) {
            Log::debug("Cache miss: {$cacheKey}");
            return TeamMember::all();
        });

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
        Cache::forget('team_members_all');
        Log::debug('Cache cleared: team_members_all');

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
        Cache::forget('team_members_all');
        Log::debug('Cache cleared: team_members_all');

        return redirect()->route('dashboard.team')->with('status', 'Team member updated');
    }

    public function destroy(TeamMember $member)
    {
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();
        Cache::forget('team_members_all');
        Log::debug('Cache cleared: team_members_all');

        return redirect()->route('dashboard.team')->with('status', 'Team member deleted');
    }
}
