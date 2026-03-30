<x-admin-dashboard-layout title="Edit Job Posting">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.careers.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            Edit Job Posting
        </div>
    </x-slot>

    <form method="POST" action="{{ route('admin.careers.update', $career) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Job Title *</label>
                            <input type="text" name="title" value="{{ old('title', $career->title) }}" class="input-field" required placeholder="e.g. Senior Software Engineer">
                            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $career->slug) }}" class="input-field">
                            <p class="text-xs text-gray-500 mt-1">Current URL: /careers/{{ $career->slug }}</p>
                            @error('slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea name="description" rows="6" class="input-field" required placeholder="Describe the role, team, and what makes this opportunity unique...">{{ old('description', $career->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Details</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                            <textarea name="requirements" rows="5" class="input-field" placeholder="List the skills, experience, and qualifications required...">{{ old('requirements', $career->requirements) }}</textarea>
                            @error('requirements') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Responsibilities</label>
                            <textarea name="responsibilities" rows="5" class="input-field" placeholder="Describe the key responsibilities and day-to-day tasks...">{{ old('responsibilities', $career->responsibilities) }}</textarea>
                            @error('responsibilities') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Benefits</label>
                            <textarea name="benefits" rows="4" class="input-field" placeholder="List the benefits and perks...">{{ old('benefits', $career->benefits) }}</textarea>
                            @error('benefits') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $career->meta_title) }}" class="input-field" placeholder="SEO title (defaults to job title)">
                            @error('meta_title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_description" rows="2" class="input-field" placeholder="Brief description for search engines...">{{ old('meta_description', $career->meta_description) }}</textarea>
                            @error('meta_description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Stats -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Views</span>
                            <span class="font-semibold text-gray-900">{{ number_format($career->view_count) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Applications</span>
                            <span class="font-semibold text-gray-900">{{ number_format($career->application_count) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Created</span>
                            <span class="font-semibold text-gray-900">{{ $career->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($career->published_at)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Published</span>
                                <span class="font-semibold text-gray-900">{{ $career->published_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                    </div>
                    @if($career->applications_count > 0)
                        <a href="{{ route('admin.careers.applications', $career) }}" class="btn-secondary w-full justify-center mt-4">
                            View Applications
                        </a>
                    @endif
                </div>

                <!-- Publish Settings -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Publish Settings</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select name="status" class="input-field" required>
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $career->status) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Closing Date</label>
                            <input type="date" name="closes_at" value="{{ old('closes_at', $career->closes_at?->format('Y-m-d')) }}" class="input-field">
                            <p class="text-xs text-gray-500 mt-1">Leave blank for no closing date</p>
                            @error('closes_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Job Info -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select name="department" class="input-field">
                                <option value="">Select Department</option>
                                @foreach($departments as $key => $label)
                                    <option value="{{ $key }}" {{ old('department', $career->department) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('department') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                            <input type="text" name="location" value="{{ old('location', $career->location) }}" class="input-field" required placeholder="e.g. Kampala, Uganda">
                            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Job Type *</label>
                            <select name="job_type" class="input-field" required>
                                @foreach($jobTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_type', $career->job_type) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('job_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Salary Range</label>
                            <input type="text" name="salary_range" value="{{ old('salary_range', $career->salary_range) }}" class="input-field" placeholder="e.g. $80,000 - $120,000">
                            @error('salary_range') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="content-card p-6">
                    <div class="flex flex-col gap-3">
                        <button type="submit" class="btn-primary w-full justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Job Posting
                        </button>
                        @if($career->status === 'published')
                            <a href="{{ route('careers.show', $career) }}" target="_blank" class="btn-secondary w-full justify-center">
                                View Live
                            </a>
                        @endif
                        <a href="{{ route('admin.careers.index') }}" class="btn-secondary w-full justify-center">Cancel</a>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="content-card p-6 border-red-200">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>
                    <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" onsubmit="return confirm('Are you sure you want to delete this job posting? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition-colors text-sm font-medium">
                            Delete Job Posting
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </form>
</x-admin-dashboard-layout>
