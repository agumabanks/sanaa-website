@props(['data' => []])

<section class="py-16 md:py-20 bg-gradient-to-r from-emerald-600 to-emerald-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if(!empty($data['title']))
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ $data['title'] }}
            </h2>
        @endif

        @if(!empty($data['description']))
            <p class="text-lg text-emerald-100 mb-8 max-w-2xl mx-auto">
                {{ $data['description'] }}
            </p>
        @endif

        @if(!empty($data['button_text']) && !empty($data['button_url']))
            <a href="{{ $data['button_url'] }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-emerald-600 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                {{ $data['button_text'] }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        @endif
    </div>
</section>
