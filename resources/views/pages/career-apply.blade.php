@extends('layouts.landing')

@section('title', 'Apply for ' . $career->title . ' | Careers | ' . config('app.name'))

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-12 bg-gradient-to-b from-gray-900 to-gray-800 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-emerald-500/30 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center gap-2 text-sm text-gray-400">
                    <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers</a></li>
                    <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li><a href="{{ route('careers.show', $career) }}" class="hover:text-white transition-colors">{{ Str::limit($career->title, 30) }}</a></li>
                    <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white">Apply</li>
                </ol>
            </nav>

            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Apply for {{ $career->title }}</h1>
            <p class="text-gray-400">{{ $career->location }} &bull; {{ $career->job_type_label }}</p>
        </div>
    </section>

    <!-- Application Form -->
    <section class="py-16 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-8">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('careers.apply.submit', $career) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Personal Information -->
                <div class="bg-gray-50 rounded-2xl p-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Personal Information</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name', auth()->user()?->name ? explode(' ', auth()->user()->name)[0] : '') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name', auth()->user()?->name ? (explode(' ', auth()->user()->name)[1] ?? '') : '') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+256 700 000 000" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="City, Country" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Online Presence -->
                <div class="bg-gray-50 rounded-2xl p-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Online Presence</h2>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn Profile</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </span>
                                <input type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/yourprofile" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            @error('linkedin_url') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Portfolio / Website</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </span>
                                <input type="url" name="portfolio_url" value="{{ old('portfolio_url') }}" placeholder="https://yourportfolio.com" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            @error('portfolio_url') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Resume & Cover Letter -->
                <div class="bg-gray-50 rounded-2xl p-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Application Documents</h2>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Resume / CV *</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-500 transition-colors cursor-pointer" onclick="document.getElementById('resume').click()">
                                <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="hidden" required onchange="updateFileName(this)">
                                <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-gray-600" id="resume-label">Click to upload or drag and drop</p>
                                <p class="text-sm text-gray-400 mt-1">PDF, DOC, or DOCX (max 5MB)</p>
                            </div>
                            @error('resume') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cover Letter</label>
                            <textarea name="cover_letter" rows="6" placeholder="Tell us why you're interested in this role and what makes you a great fit..." class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('cover_letter') }}</textarea>
                            <p class="text-sm text-gray-400 mt-1">Optional, but recommended</p>
                            @error('cover_letter') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="flex-1 py-4 text-center text-white bg-emerald-500 rounded-xl font-semibold hover:bg-emerald-600 transition-colors">
                        Submit Application
                    </button>
                    <a href="{{ route('careers.show', $career) }}" class="px-8 py-4 text-center text-gray-600 bg-gray-100 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                        Cancel
                    </a>
                </div>

                <p class="text-sm text-gray-500 text-center">
                    By submitting this application, you agree to our <a href="{{ route('policies.privacy-notice') }}" class="text-emerald-600 hover:underline">Privacy Policy</a>.
                </p>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function updateFileName(input) {
        const label = document.getElementById('resume-label');
        if (input.files && input.files[0]) {
            label.textContent = input.files[0].name;
            label.classList.add('text-emerald-600', 'font-medium');
        }
    }
</script>
@endpush
