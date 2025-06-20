@props([
    'variant' => 'primary',
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center px-4 py-2 rounded-md font-semibold transition focus:outline-none';
    $variants = [
        'primary' => 'bg-black text-white hover:bg-gray-900 border border-transparent',
        'secondary' => 'bg-white text-black hover:bg-gray-100 border border-transparent',
        'ghost' => 'bg-transparent text-white border border-white hover:bg-white hover:text-black',
    ];
    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

@if($attributes->has('href'))
<a {{ $attributes->merge(['class' => $base.' '.$classes]) }}>
    {{ $slot }}
</a>
@else
<button type="{{ $type }}" {{ $attributes->merge(['class' => $base.' '.$classes]) }}>
    {{ $slot }}
</button>
@endif
