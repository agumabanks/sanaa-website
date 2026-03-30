<x-dashboard-layout title="Services Page Settings">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Services Page Settings</h2>
            <div class="flex gap-2">
                <a href="{{ route('services') }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-medium py-2 px-3 hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Preview Page
                </a>
                <a href="{{ route('dashboard.services.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-medium py-2 px-3 hover:bg-gray-50">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                    Back to Services
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('dashboard.services.page.update') }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Hero Section -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Hero Section</h3>
                        <p class="text-sm text-gray-500 mt-1">The main banner at the top of the services page</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="hero_eyebrow" class="block text-sm font-medium text-gray-700">Eyebrow Text</label>
                                <input type="text" id="hero_eyebrow" name="hero_eyebrow" value="{{ $settings['hero_eyebrow'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="hero_title" class="block text-sm font-medium text-gray-700">Main Title</label>
                                <input type="text" id="hero_title" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                        <div>
                            <label for="hero_subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
                            <textarea id="hero_subtitle" name="hero_subtitle" rows="3" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="hero_cta_primary_text" class="block text-sm font-medium text-gray-700">Primary Button Text</label>
                                <input type="text" id="hero_cta_primary_text" name="hero_cta_primary_text" value="{{ $settings['hero_cta_primary_text'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="hero_cta_secondary_text" class="block text-sm font-medium text-gray-700">Secondary Button Text</label>
                                <input type="text" id="hero_cta_secondary_text" name="hero_cta_secondary_text" value="{{ $settings['hero_cta_secondary_text'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Stats Section</h3>
                        <p class="text-sm text-gray-500 mt-1">The four statistics displayed below the hero</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @for($i = 1; $i <= 4; $i++)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <label for="stat_{{ $i }}_value" class="block text-sm font-medium text-gray-700">Stat {{ $i }} Value</label>
                                <input type="text" id="stat_{{ $i }}_value" name="stat_{{ $i }}_value" value="{{ $settings["stat_{$i}_value"] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2 px-3 text-lg font-bold focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                                <label for="stat_{{ $i }}_label" class="block text-sm font-medium text-gray-700 mt-2">Stat {{ $i }} Label</label>
                                <input type="text" id="stat_{{ $i }}_label" name="stat_{{ $i }}_label" value="{{ $settings["stat_{$i}_label"] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Services Section Header -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Services Section</h3>
                        <p class="text-sm text-gray-500 mt-1">Header text for the services grid (services are managed separately)</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="services_eyebrow" class="block text-sm font-medium text-gray-700">Eyebrow Text</label>
                                <input type="text" id="services_eyebrow" name="services_eyebrow" value="{{ $settings['services_eyebrow'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="services_title" class="block text-sm font-medium text-gray-700">Section Title</label>
                                <input type="text" id="services_title" name="services_title" value="{{ $settings['services_title'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                        <div>
                            <label for="services_subtitle" class="block text-sm font-medium text-gray-700">Section Subtitle</label>
                            <textarea id="services_subtitle" name="services_subtitle" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">{{ $settings['services_subtitle'] ?? '' }}</textarea>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-700">
                                <strong>Note:</strong> Individual services are managed from the 
                                <a href="{{ route('dashboard.services.index') }}" class="underline">Services list</a>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Why Sanaa Section -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Why Sanaa Section</h3>
                        <p class="text-sm text-gray-500 mt-1">The "Built for African Realities" section</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="why_eyebrow" class="block text-sm font-medium text-gray-700">Eyebrow Text</label>
                                <input type="text" id="why_eyebrow" name="why_eyebrow" value="{{ $settings['why_eyebrow'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="why_title" class="block text-sm font-medium text-gray-700">Section Title</label>
                                <input type="text" id="why_title" name="why_title" value="{{ $settings['why_title'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                        <div>
                            <label for="why_subtitle" class="block text-sm font-medium text-gray-700">Section Subtitle</label>
                            <textarea id="why_subtitle" name="why_subtitle" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">{{ $settings['why_subtitle'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Sectors Section -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Who We Serve Section</h3>
                        <p class="text-sm text-gray-500 mt-1">The sectors/industries you serve</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="sectors_eyebrow" class="block text-sm font-medium text-gray-700">Eyebrow Text</label>
                                <input type="text" id="sectors_eyebrow" name="sectors_eyebrow" value="{{ $settings['sectors_eyebrow'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="sectors_title" class="block text-sm font-medium text-gray-700">Section Title</label>
                                <input type="text" id="sectors_title" name="sectors_title" value="{{ $settings['sectors_title'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">CTA Section</h3>
                        <p class="text-sm text-gray-500 mt-1">The call-to-action section at the bottom</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cta_eyebrow" class="block text-sm font-medium text-gray-700">Eyebrow Text</label>
                                <input type="text" id="cta_eyebrow" name="cta_eyebrow" value="{{ $settings['cta_eyebrow'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="cta_title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="cta_title" name="cta_title" value="{{ $settings['cta_title'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                        <div>
                            <label for="cta_subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
                            <textarea id="cta_subtitle" name="cta_subtitle" rows="2" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">{{ $settings['cta_subtitle'] ?? '' }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="cta_primary_text" class="block text-sm font-medium text-gray-700">Primary Button Text</label>
                                <input type="text" id="cta_primary_text" name="cta_primary_text" value="{{ $settings['cta_primary_text'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="cta_secondary_text" class="block text-sm font-medium text-gray-700">Secondary Button Text</label>
                                <input type="text" id="cta_secondary_text" name="cta_secondary_text" value="{{ $settings['cta_secondary_text'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                            <div>
                                <label for="cta_secondary_link" class="block text-sm font-medium text-gray-700">Secondary Button Link</label>
                                <input type="text" id="cta_secondary_link" name="cta_secondary_link" value="{{ $settings['cta_secondary_link'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                            </div>
                        </div>
                        <div>
                            <label for="cta_footer" class="block text-sm font-medium text-gray-700">Footer Text</label>
                            <input type="text" id="cta_footer" name="cta_footer" value="{{ $settings['cta_footer'] ?? '' }}" class="mt-1 w-full rounded-lg border border-gray-300 py-2.5 px-3 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400">
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('dashboard.services.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white text-gray-700 px-6 py-3 text-sm font-medium hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-6 py-3 text-sm font-medium hover:bg-emerald-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
