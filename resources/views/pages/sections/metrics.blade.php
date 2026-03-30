@php
    $metrics = [
        ['label' => 'Building since', 'value' => '2021'],
        ['label' => 'Cooperative registered', 'value' => '2022'],
        ['label' => 'Active countries', 'value' => 'Uganda, DRC'],
        ['label' => 'Products live', 'value' => '8+'],
        ['label' => 'Legal entities', 'value' => '3'],
    ];
@endphp

<section class="hero-stats-section" aria-label="Sanaa facts">
    <div class="hero-stats-wrap">
        {{-- TODO: Replace with live metrics from DB when analytics are wired --}}
        @foreach($metrics as $metric)
            <div class="hero-stat">
                <div class="hero-stat-value">{{ $metric['value'] }}</div>
                <div class="hero-stat-label">{{ $metric['label'] }}</div>
            </div>
        @endforeach
    </div>
</section>
