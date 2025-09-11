@extends('layouts.finance', [
    'title' => 'Cards — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Cards'] ],
])
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Cards</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600">
                <tr>
                    <th class="py-2 pr-6">Product</th>
                    <th class="py-2 pr-6">Fees</th>
                    <th class="py-2 pr-6">Features</th>
                    <th class="py-2 pr-6">Eligibility</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cards as $c)
                    <tr class="border-t">
                        <td class="py-3 pr-6">
                            <div class="font-medium">{{ $c->name }}</div>
                        </td>
                        <td class="py-3 pr-6 text-gray-700">
                            @if($c->fees)
                                <ul class="list-disc pl-5">
                                    @foreach($c->fees as $k=>$v)
                                        <li><span class="font-medium">{{ $k }}:</span> {{ $v }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td class="py-3 pr-6 text-gray-700">
                            @if($c->features)
                                <ul class="list-disc pl-5">
                                    @foreach($c->features as $f)
                                        <li>{{ $f }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td class="py-3 pr-6 text-gray-700">{!! nl2br(e($c->eligibility)) !!}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-6 text-gray-600">No cards published.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'itemListElement' => $cards->map(function($c, $i){
        return [
            '@type' => 'ListItem',
            'position' => $i+1,
            'item' => [
                '@type' => 'FinancialProduct',
                'name' => $c->name,
                'description' => $c->features ? implode(', ', (array) $c->features) : null,
            ],
        ];
    })->values(),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endsection

