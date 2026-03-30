<x-admin-dashboard-layout title="Create Job Posting">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.careers.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            Create Job Posting
        </div>
    </x-slot>

    <form method="POST" action="{{ route('admin.careers.store') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Job Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="input-field" required placeholder="e.g. Senior Software Engineer">
                            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="input-field" placeholder="auto-generated-from-title">
                            <p class="text-xs text-gray-500 mt-1">Leave blank to auto-generate from title</p>
                            @error('slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea name="description" rows="6" class="input-field" required placeholder="Describe the role, team, and what makes this opportunity unique...">{{ old('description') }}</textarea>
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
                            <textarea name="requirements" rows="5" class="input-field" placeholder="List the skills, experience, and qualifications required...">{{ old('requirements') }}</textarea>
                            @error('requirements') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Responsibilities</label>
                            <textarea name="responsibilities" rows="5" class="input-field" placeholder="Describe the key responsibilities and day-to-day tasks...">{{ old('responsibilities') }}</textarea>
                            @error('responsibilities') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Benefits</label>
                            <textarea name="benefits" rows="4" class="input-field" placeholder="List the benefits and perks...">{{ old('benefits') }}</textarea>
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
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="input-field" placeholder="SEO title (defaults to job title)">
                            @error('meta_title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_description" rows="2" class="input-field" placeholder="Brief description for search engines...">{{ old('meta_description') }}</textarea>
                            @error('meta_description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="content-card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Publish Settings</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select name="status" class="input-field" required>
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', 'draft') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Closing Date</label>
                            <input type="date" name="closes_at" value="{{ old('closes_at') }}" class="input-field">
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
                                    <option value="{{ $key }}" {{ old('department') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('department') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="input-field" required placeholder="e.g. Kampala, Uganda">
                            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Job Type *</label>
                            <select name="job_type" class="input-field" required>
                                @foreach($jobTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_type', 'full-time') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('job_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Salary Range</label>
                            <input type="text" name="salary_range" value="{{ old('salary_range') }}" class="input-field" placeholder="e.g. $80,000 - $120,000">
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
                            Create Job Posting
                        </button>
                        <a href="{{ route('admin.careers.index') }}" class="btn-secondary w-full justify-center">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-dashboard-layout>
