<section id="industries" class="industry-premium py-24">
  <div class="relative max-w-6xl mx-auto px-4">
    <div class="section-header text-center mb-10">
      <div class="section-eyebrow mb-2">{{ $section->getTranslation('eyebrow') }}</div>
      <h2 class="section-title visible">{{ $section->getTranslation('title') }}</h2>
    </div>
    <div class="industry-grid">
      @forelse($industries as $industry)
      <div class="industry-card">
        <div class="industry-media">
          @if($industry->image)
            <img src="{{ asset('storage/' . $industry->image) }}" alt="{{ $industry->title }}" loading="lazy" onerror="this.style.display='none'">
          @endif
        </div>
        <div class="industry-body">
          <div>
            <div class="industry-title">{{ __($industry->title) }}</div>
            <div class="industry-meta">{{ __($industry->subtitle) }}</div>
          </div>
          <a class="industry-link" href="{{ $industry->link ?? route('services') }}">{{ __('Learn more') }} →</a>
        </div>
      </div>
      @empty
      <div class="industry-card">
        <div class="industry-media"></div>
        <div class="industry-body">
          <div>
            <div class="industry-title">Food & Beverage</div>
            <div class="industry-meta">Quick service, full service, bars</div>
          </div>
          <a class="industry-link" href="{{ route('services') }}">{{ __('Learn more') }} →</a>
        </div>
      </div>
      {{-- More fallback cards could go here --}}
      @endforelse
    </div>
  </div>
</section>
