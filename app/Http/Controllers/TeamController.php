<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TeamController extends Controller
{
    public function adminIndex()
    {
        $teamMembers = \App\Models\TeamMember::orderBy('name')->get();

        $availableImages = collect();
        try {
            $disk = \Illuminate\Support\Facades\Storage::disk('public');
            $dirs = ['team','images','images/team','uploads','photos','media','avatars','blog',''];
            $files = collect();
            foreach ($dirs as $dir) {
                if ($dir === '' || $disk->exists($dir)) {
                    try {
                        $files = $files->merge($disk->allFiles($dir));
                    } catch (\Throwable $e) {
                        // skip directory if unreadable
                    }
                }
            }
            $availableImages = $files
                ->filter(fn($p) => preg_match('/\.(jpe?g|png|gif|webp|svg)$/i', $p))
                ->unique()
                ->map(function ($p) use ($disk) {
                    $modified = 0;
                    try { $modified = $disk->lastModified($p); } catch (\Throwable $e) {}
                    return [
                        'path' => $p,
                        'url' => asset('storage/'.$p),
                        'name' => basename($p),
                        'modified' => $modified,
                    ];
                })
                ->sortByDesc('modified')
                ->values()
                ->take(200);
        } catch (\Throwable $e) {
            $availableImages = collect();
        }

        // Build paginator for image browser
        $perPage = (int) request('img_per_page', 24);
        $perPage = $perPage > 0 && $perPage <= 96 ? $perPage : 24;
        $page = max(1, (int) request('img_page', 1));
        $total = $availableImages->count();
        $items = $availableImages->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            [
                'path' => url()->current(),
                'pageName' => 'img_page',
            ]
        );

        return view('admin.team.index', [
            'members' => $teamMembers,
            'availableImages' => $availableImages,
            'availableImagesPage' => $paginator,
        ]);
    }
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
        $availableImages = collect();
        try {
            $disk = Storage::disk('public');
            $dirs = ['team','images','images/team','uploads','photos','media','avatars','blog',''];
            $files = collect();
            foreach ($dirs as $dir) {
                if ($dir === '' || $disk->exists($dir)) {
                    try {
                        $files = $files->merge($disk->allFiles($dir));
                    } catch (\Throwable $e) {}
                }
            }
            $availableImages = $files
                ->filter(fn($p) => preg_match('/\.(jpe?g|png|gif|webp|svg)$/i', $p))
                ->unique()
                ->map(function ($p) use ($disk) {
                    $modified = 0;
                    try { $modified = $disk->lastModified($p); } catch (\Throwable $e) {}
                    return [
                        'path' => $p,
                        'url' => asset('storage/'.$p),
                        'name' => basename($p),
                        'modified' => $modified,
                    ];
                })
                ->sortByDesc('modified')
                ->values()
                ->take(100);
        } catch (\Throwable $e) {
            $availableImages = collect();
        }

        return view('admin.team.edit', compact('member', 'availableImages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'photo_existing' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        } elseif (!empty($data['photo_existing'])) {
            $existing = ltrim(str_replace(['/storage/', 'storage/'], '', $data['photo_existing']), '/');
            // allow only within public disk
            $data['photo'] = $existing;
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'photo_existing' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        } elseif (!empty($data['photo_existing'])) {
            $existing = ltrim(str_replace(['/storage/', 'storage/'], '', $data['photo_existing']), '/');
            $data['photo'] = $existing;
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
