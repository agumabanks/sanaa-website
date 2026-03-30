<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::query()->withCount('applications');

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->byDepartment($request->department);
        }

        // Filter by job type
        if ($request->filled('job_type')) {
            $query->byType($request->job_type);
        }

        $careers = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total' => Career::count(),
            'published' => Career::published()->count(),
            'draft' => Career::draft()->count(),
            'closed' => Career::closed()->count(),
            'applications' => JobApplication::count(),
            'new_applications' => JobApplication::byStatus('new')->count(),
        ];

        // Get unique departments and locations for filters
        $departments = Career::departments();
        $jobTypes = Career::jobTypes();

        return view('admin.careers.index', compact('careers', 'stats', 'departments', 'jobTypes'));
    }

    public function create()
    {
        $departments = Career::departments();
        $jobTypes = Career::jobTypes();
        $statuses = Career::statuses();

        return view('admin.careers.create', compact('departments', 'jobTypes', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug',
            'description' => 'required|string',
            'department' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,contract,internship,remote',
            'salary_range' => 'nullable|string|max:100',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'required|in:draft,published,closed',
            'closes_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $validated['created_by'] = auth()->id();

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $career = Career::create($validated);

        return redirect()
            ->route('admin.careers.index')
            ->with('success', "Job posting \"{$career->title}\" has been created.");
    }

    public function show(Career $career)
    {
        $career->load(['applications' => function ($query) {
            $query->orderByDesc('created_at')->limit(10);
        }, 'creator']);

        $applicationStats = [
            'total' => $career->applications()->count(),
            'new' => $career->applications()->byStatus('new')->count(),
            'reviewing' => $career->applications()->byStatus('reviewing')->count(),
            'interview' => $career->applications()->byStatus('interview')->count(),
            'hired' => $career->applications()->byStatus('hired')->count(),
        ];

        return view('admin.careers.show', compact('career', 'applicationStats'));
    }

    public function edit(Career $career)
    {
        $departments = Career::departments();
        $jobTypes = Career::jobTypes();
        $statuses = Career::statuses();

        return view('admin.careers.edit', compact('career', 'departments', 'jobTypes', 'statuses'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug,' . $career->id,
            'description' => 'required|string',
            'department' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,contract,internship,remote',
            'salary_range' => 'nullable|string|max:100',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'required|in:draft,published,closed',
            'closes_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Set published_at if transitioning to published
        if ($validated['status'] === 'published' && $career->status !== 'published') {
            $validated['published_at'] = now();
        }

        $career->update($validated);

        return redirect()
            ->route('admin.careers.index')
            ->with('success', "Job posting \"{$career->title}\" has been updated.");
    }

    public function destroy(Career $career)
    {
        $title = $career->title;
        $career->delete();

        return redirect()
            ->route('admin.careers.index')
            ->with('success', "Job posting \"{$title}\" has been deleted.");
    }

    public function toggleStatus(Career $career)
    {
        if ($career->status === 'published') {
            $career->close();
            $message = "Job posting \"{$career->title}\" has been closed.";
        } else {
            $career->publish();
            $message = "Job posting \"{$career->title}\" has been published.";
        }

        return back()->with('success', $message);
    }

    // Applications management
    public function applications(Career $career, Request $request)
    {
        $query = $career->applications()->with('user');

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        $applications = $query->orderByDesc('created_at')->paginate(20)->withQueryString();
        $statuses = JobApplication::statuses();

        return view('admin.careers.applications', compact('career', 'applications', 'statuses'));
    }

    public function updateApplicationStatus(Request $request, Career $career, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,reviewing,screening,interview,offer,hired,rejected,withdrawn',
            'notes' => 'nullable|string',
        ]);

        $validated['reviewed_by'] = auth()->id();
        $validated['reviewed_at'] = now();

        $application->update($validated);

        // Update career application count
        $career->updateApplicationCount();

        return back()->with('success', 'Application status updated.');
    }
}
