<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sanaa Cards Page Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.sanaa-cards.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <h3 class="font-bold text-lg mb-4 text-emerald-600">Hero Section</h3>
                        <div class="grid grid-cols-1 gap-6 mb-6 text-gray-800">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Badge Text</label>
                                <input type="text" name="hero_badge" value="{{ $settings['hero_badge'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Hero Title (HTML allowed)</label>
                                <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Description</label>
                                <textarea name="hero_description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ $settings['hero_description'] ?? '' }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Primary CTA</label>
                                    <input type="text" name="hero_cta_primary" value="{{ $settings['hero_cta_primary'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Secondary CTA</label>
                                    <input type="text" name="hero_cta_secondary" value="{{ $settings['hero_cta_secondary'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Hero Visual (Dashboard Mockup)</label>
                                @if(isset($settings['hero_visual']))
                                    <img src="{{ $settings['hero_visual'] }}" class="h-20 mb-2 rounded border">
                                @endif
                                <input type="file" name="hero_visual" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <h3 class="font-bold text-lg mb-4 text-emerald-600">Physical Product Visual</h3>
                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700">Card Mockup Visual</label>
                            @if(isset($settings['card_visual']))
                                <img src="{{ $settings['card_visual'] }}" class="h-20 mb-2 rounded border">
                            @endif
                            <input type="file" name="card_visual" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700">Section Title</label>
                            <input type="text" name="features_title" value="{{ $settings['features_title'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                            <label class="block font-medium text-sm text-gray-700">Section Subtitle</label>
                            <textarea name="features_subtitle" rows="2" class="w-full border-gray-300 rounded-md shadow-sm">{{ $settings['features_subtitle'] ?? '' }}</textarea>
                        </div>

                        <h3 class="font-bold text-lg mb-4 text-emerald-600">Call to Action (Footer)</h3>
                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700">CTA Title</label>
                            <input type="text" name="cta_title" value="{{ $settings['cta_title'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                            <label class="block font-medium text-sm text-gray-700">CTA Subtitle</label>
                            <input type="text" name="cta_subtitle" value="{{ $settings['cta_subtitle'] ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
