<section id="capabilities" class="py-24 bg-black">
  <div class="relative max-w-6xl mx-auto px-4">
    <div class="section-header text-center mb-10">
      <div class="section-eyebrow mb-2">{{ $section->getTranslation('eyebrow') }}</div>
      <h2 class="section-title visible">{{ $section->getTranslation('title') }}</h2>
    </div>
    <div class="industry-grid">
      @forelse($capabilities as $capability)
      <div class="pricing-card">
        <div class="flex items-start gap-3 mb-4">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" class="text-emerald-400"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
          <div>
            <div class="industry-title">{{ __($capability->title) }}</div>
            <div class="industry-meta">{{ __($capability->description) }}</div>
          </div>
        </div>
        <a href="{{ $capability->link ?? route('services') }}" class="industry-link">{{ __('Learn more') }} →</a>
      </div>
      @empty
      {{-- Fallback cards --}}
      @endforelse
    </div>
  </div>
</section>
