@props(['data' => []])

<section class="relative py-20 md:py-32 bg-gradient-to-b from-gray-900 to-gray-800 overflow-hidden">
    @if(!empty($data['background_image']))
        <div class="absolute inset-0">
            <img src="{{ $data['background_image'] }}" alt="" class="w-full h-full object-cover opacity-30">
        </div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900/50"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if(!empty($data['title']))
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {!! nl2br(e($data['title'])) !!}
            </h1>
        @endif

        @if(!empty($data['subtitle']))
            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-3xl mx-auto">
                {!! nl2br(e($data['subtitle'])) !!}
            </p>
        @endif

        @if(!empty($data['cta_text']) && !empty($data['cta_url']))
            <a href="{{ $data['cta_url'] }}" class="inline-flex items-center gap-2 px-8 py-4 bg-emerald-500 text-white rounded-full font-semibold hover:bg-emerald-600 transition-colors">
                {{ $data['cta_text'] }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        @endif
    </div>
</section>
