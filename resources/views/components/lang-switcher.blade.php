@php
  $current = app()->getLocale();
  $locales = [
    'en' => __('messages.lang.en'),
    'fr' => __('messages.lang.fr'),
    'sw' => __('messages.lang.sw'),
    'es' => __('messages.lang.es'),
  ];
@endphp

<div class="lang-switcher" style="display:flex; align-items:center; gap:.5rem;">
  <span style="font-size:.75rem; opacity:.7;">{{ __('messages.lang.label') }}:</span>
  @foreach($locales as $code => $label)
    <a
      href="{{ route('locale.set', $code) }}"
      style="text-decoration:none; font-size:.8rem; padding:.25rem .5rem; border-radius:999px; {{ $current === $code ? 'background:#10b981;color:#000;font-weight:600;' : 'border:1px solid rgba(255,255,255,.35); color:#fff;' }}"
      aria-current="{{ $current === $code ? 'true' : 'false' }}"
    >
      {{ strtoupper($code) }}
    </a>
  @endforeach
</div>

