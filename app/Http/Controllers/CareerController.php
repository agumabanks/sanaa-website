<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::active();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->byDepartment($request->department);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        // Filter by job type
        if ($request->filled('job_type')) {
            $query->byType($request->job_type);
        }

        $careers = $query->orderByDesc('published_at')->paginate(12)->withQueryString();

        // Get unique values for filters
        $departments = Career::active()
            ->whereNotNull('department')
            ->distinct()
            ->pluck('department')
            ->filter()
            ->mapWithKeys(fn($dept) => [$dept => Career::departments()[$dept] ?? ucfirst($dept)]);

        $locations = Career::active()
            ->distinct()
            ->pluck('location')
            ->filter();

        $jobTypes = Career::jobTypes();

        // Stats for hero section
        $stats = [
            'total_positions' => Career::active()->count(),
            'departments' => Career::active()->whereNotNull('department')->distinct('department')->count('department'),
            'locations' => Career::active()->distinct('location')->count('location'),
        ];

        return view('pages.careers', compact('careers', 'departments', 'locations', 'jobTypes', 'stats'));
    }

    public function show(Career $career)
    {
        // Only show published careers (or all to admins)
        if ($career->status !== 'published' && !(auth()->check() && auth()->user()->isAdmin())) {
            abort(404);
        }

        // Increment view count
        $career->incrementViewCount();

        // Get related jobs (same department, different job)
        $relatedJobs = Career::active()
            ->where('id', '!=', $career->id)
            ->when($career->department, function ($query) use ($career) {
                $query->where('department', $career->department);
            })
            ->limit(3)
            ->get();

        return view('pages.career-show', compact('career', 'relatedJobs'));
    }

    public function apply(Career $career)
    {
        if (!$career->is_active) {
            return redirect()
                ->route('careers')
                ->with('error', 'This position is no longer accepting applications.');
        }

        return view('pages.career-apply', compact('career'));
    }

    public function submitApplication(Request $request, Career $career)
    {
        if (!$career->is_active) {
            return redirect()
                ->route('careers')
                ->with('error', 'This position is no longer accepting applications.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:500',
            'portfolio_url' => 'nullable|url|max:500',
            'cover_letter' => 'nullable|string|max:5000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'screening_answers' => 'nullable|array',
        ]);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $validated['resume_path'] = $request->file('resume')->store('resumes', 'public');
        }

        // Add user ID if authenticated
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        $validated['career_id'] = $career->id;
        $validated['source'] = $request->input('source', 'website');

        // Create application
        $application = JobApplication::create($validated);

        // Update career application count
        $career->updateApplicationCount();

        return redirect()
            ->route('careers.show', $career)
            ->with('success', 'Your application has been submitted successfully! We will review it and get back to you soon.');
    }

    // Legacy store method for admin dashboard (kept for backwards compatibility)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,contract,internship,remote',
        ]);

        $data['created_by'] = auth()->id();
        $data['status'] = 'draft';

        Career::create($data);

        return redirect()->route('admin.careers.index')->with('success', 'Career created');
    }
}
