@props([
    'level' => 1,
])

@php
    $level = (int) $level;
    if ($level < 1 || $level > 6) {
        $level = 1;
    }
    $tag = 'h' . $level;
@endphp

<{{ $tag }} {{ $attributes->class(['m-0']) }}>
    {{ $slot }}
</{{ $tag }}>
