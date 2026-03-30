@extends('layouts.dashboard', ['title' => 'Admin → Finance'])
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Finance Admin</h1>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @php
            $cards = [
                ['label' => 'Pricing Plans', 'route' => 'admin.finance.pricing-plans.index'],
                ['label' => 'Cards', 'route' => 'admin.finance.cards.index'],
                ['label' => 'Technologies', 'route' => 'admin.finance.technologies.index'],
                ['label' => 'Team', 'route' => 'admin.finance.team-members.index'],
                ['label' => 'Communities', 'route' => 'admin.finance.communities.index'],
                ['label' => 'Compliance', 'route' => 'admin.finance.compliance-items.index'],
                ['label' => 'Pages', 'route' => 'admin.finance.pages.index'],
                ['label' => 'Analytics', 'route' => 'admin.finance.analytics'],
            ];
        @endphp
        @foreach($cards as $c)
            <a href="{{ route($c['route']) }}" class="block rounded-lg border border-gray-200 bg-white p-4 hover:border-gray-300">
                <div class="flex items-center justify-between">
                    <div class="font-medium">{{ $c['label'] }}</div>
                    <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6l6 6-6 6-1.41-1.41L12.17 12 8.59 7.41z"/></svg>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

