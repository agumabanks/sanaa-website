@props(['data' => []])

@php
    $items = $data['items'] ?? [];
    $title = $data['title'] ?? 'Frequently Asked Questions';
@endphp

<section class="py-16 md:py-20" x-data="{ openIndex: null }">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12 text-center">{{ $title }}</h2>

        @if(count($items) > 0)
            <div class="space-y-4">
                @foreach($items as $index => $item)
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button
                            @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between p-6 text-left bg-white hover:bg-gray-50 transition-colors"
                        >
                            <span class="font-semibold text-gray-900">{{ $item['question'] ?? '' }}</span>
                            <svg
                                class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                :class="{ 'rotate-180': openIndex === {{ $index }} }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div
                            x-show="openIndex === {{ $index }}"
                            x-collapse
                            class="px-6 pb-6"
                        >
                            <p class="text-gray-600">{!! nl2br(e($item['answer'] ?? '')) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
