@props(['data' => []])

@php
    $columns = $data['columns'] ?? 3;
    $items = $data['items'] ?? [];
    $title = $data['title'] ?? '';
    $subtitle = $data['subtitle'] ?? '';
@endphp

<section class="py-16 md:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($title || $subtitle)
            <div class="text-center mb-12">
                @if($title)
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ $subtitle }}</p>
                @endif
            </div>
        @endif

        @if(count($items) > 0)
            <div class="grid md:grid-cols-{{ $columns }} gap-8">
                @foreach($items as $item)
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        @if(!empty($item['icon']))
                            <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center mb-6">
                                <i data-lucide="{{ $item['icon'] }}" class="w-7 h-7 text-emerald-600"></i>
                            </div>
                        @endif
                        @if(!empty($item['title']))
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $item['title'] }}</h3>
                        @endif
                        @if(!empty($item['description']))
                            <p class="text-gray-600">{{ $item['description'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
