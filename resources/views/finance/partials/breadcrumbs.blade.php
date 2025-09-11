@php
    $crumbs = $breadcrumbs ?? [];
    $list = collect([
        ['name' => 'Finance', 'url' => route('finance.index')],
    ])->merge($crumbs);
@endphp
<ol class="flex items-center gap-2 text-gray-500">
    @foreach($list as $i => $crumb)
        @if($i > 0)
            <li aria-hidden="true">/</li>
        @endif
        <li>
            @if(!empty($crumb['url']))
                <a class="hover:text-gray-900" href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a>
            @else
                <span aria-current="page" class="text-gray-900">{{ $crumb['name'] }}</span>
            @endif
        </li>
    @endforeach
</ol>
@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => $list->values()->map(function($c, $idx){
        return [
            '@type' => 'ListItem',
            'position' => $idx + 1,
            'name' => $c['name'],
            'item' => $c['url'] ?? url()->current(),
        ];
    })->all()
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush

