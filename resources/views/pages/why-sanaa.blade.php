<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $c['meta']['title'] }}</title>
    <meta name="description" content="{{ $c['meta']['description'] }}">
    <link rel="canonical" href="{{ $c['meta']['canonical'] }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $c['meta']['title'] }}">
    <meta property="og:description" content="{{ $c['meta']['description'] }}">
    <meta property="og:image" content="{{ $c['meta']['og_image'] }}">
    <meta property="og:url" content="{{ $c['meta']['canonical'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $c['meta']['title'] }}">
    <meta name="twitter:description" content="{{ $c['meta']['description'] }}">
    <meta name="twitter:image" content="{{ $c['meta']['og_image'] }}">
    <meta name="theme-color" content="#000000">
    @vite(['resources/css/app.css'])
    <style>
      .sticky-head{backdrop-filter:saturate(180%) blur(8px)}
    </style>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "{{ $c['meta']['brand']['name'] }}",
      "url": "{{ $c['meta']['brand']['url'] }}"
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Sanaa",
      "url": "{{ url('/') }}",
      "logo": "{{ $c['meta']['brand']['logo'] }}"
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        @foreach($c['faqs'] as $i => $f)
        {
          "@type": "Question",
          "name": "{{ $f['q'] }}",
          "acceptedAnswer": {"@type": "Answer","text": "{{ $f['a'] }}"}
        }@if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>
</head>
<body class="antialiased bg-black text-white">
  <!-- Header -->
  <header id="siteHeader" class="fixed top-0 inset-x-0 z-50 transition-colors">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex h-16 items-center justify-between border-b border-white/10">
        <a href="/" class="flex items-center gap-2">
          <img src="{{ cdn_asset('storage/images/sanaa.png') }}" alt="Sanaa" class="h-7 w-7">
          <span class="sr-only">Sanaa</span>
        </a>
        <nav class="hidden md:flex items-center gap-6 text-sm text-white/80">
          <a href="{{ route('products') }}" class="hover:text-white">Products</a>
          <a href="#solutions" class="hover:text-white">Solutions</a>
          <a href="{{ route('prices') }}" class="hover:text-white">Pricing</a>
          <a href="#docs" class="hover:text-white">Docs</a>
          <a href="{{ route('support') }}" class="hover:text-white">Support</a>
          <a href="{{ route('contact') }}" class="hover:text-white">Contact</a>
        </nav>
        <div class="hidden md:flex items-center gap-3">
          <a href="#signup" data-cta="get-started" class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-500 text-black font-medium hover:bg-emerald-400">Get started</a>
          <a href="#sales" id="openSales" data-cta="contact-sales" class="inline-flex items-center px-4 py-2 rounded-lg border border-white/20 text-white/90 hover:bg-white/10">Contact sales</a>
        </div>
      </div>
    </div>
  </header>

  <main class="pt-24">
    <!-- HERO -->
    <section class="relative">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h1 class="text-4xl md:text-6xl font-semibold tracking-tight">{{ $c['hero']['title'] }}</h1>
        <p class="mt-4 text-lg text-white/80 max-w-2xl">{{ $c['hero']['subhead'] }}</p>
        <p class="mt-3 text-white/60 max-w-2xl">{{ $c['hero']['blurb'] }}</p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a href="#signup" data-cta="get-started" class="inline-flex items-center px-5 py-3 rounded-xl bg-emerald-500 text-black font-semibold hover:bg-emerald-400">Get started</a>
          <a href="#sales" id="openSales2" data-cta="contact-sales" class="inline-flex items-center px-5 py-3 rounded-xl border border-white/20 text-white hover:bg-white/10">Talk to sales</a>
        </div>
        <ul class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-white/80">
          @foreach($c['hero']['bullets'] as $b)
            <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> {{ $b }}</li>
          @endforeach
        </ul>
      </div>
    </section>

    <!-- SOCIAL PROOF -->
    <section aria-labelledby="proof" class="border-y border-white/10">
      <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 id="proof" class="text-sm uppercase tracking-wider text-white/60">Trusted by ambitious SMEs & institutions across Uganda and the EAC</h2>
        <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 items-center opacity-80">
          @foreach($c['logos'] as $logo)
            <img src="{{ $logo }}" alt="Partner logo" class="h-10 w-auto mx-auto" loading="lazy">
          @endforeach
        </div>
      </div>
    </section>

    <!-- CAPABILITIES -->
    <section aria-labelledby="capabilities">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="capabilities" class="text-2xl font-semibold">What you can do with Sanaa</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach($c['capabilities'] as $card)
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-5 hover:bg-white/[0.06] transition">
              <div class="text-2xl">{{ $card['icon'] }}</div>
              <h3 class="mt-3 font-semibold">{{ $card['title'] }}</h3>
              <p class="mt-2 text-sm text-white/70">{{ $card['copy'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- INDUSTRIES -->
    <section id="solutions" aria-labelledby="industries" class="border-y border-white/10">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="industries" class="text-2xl font-semibold">Industry solutions</h2>
        <div class="mt-6 flex flex-wrap gap-2" role="tablist" aria-label="Industries">
          @php($keys = array_keys($c['industries']))
          @foreach($keys as $i => $name)
            <button class="px-4 py-2 rounded-full border border-white/15 text-sm {{ $i===0 ? 'bg-white/10' : 'hover:bg-white/10' }}" data-tab="ind-{{ $i }}" role="tab" aria-selected="{{ $i===0 ? 'true' : 'false' }}">{{ $name }}</button>
          @endforeach
        </div>
        <div class="mt-8">
          @foreach($c['industries'] as $i => $data)
            <div id="ind-{{ $loop->index }}" class="industry-panel {{ $loop->first ? '' : 'hidden' }}" role="tabpanel">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <ul class="space-y-2 list-disc list-inside text-white/80">
                  @foreach($data['outcomes'] as $o)
                    <li>{{ $o }}</li>
                  @endforeach
                </ul>
                <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                  <div class="text-sm uppercase text-white/60">Mini case</div>
                  <div class="mt-2 text-lg">{{ $data['case'] }}</div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section aria-labelledby="how">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="how" class="text-2xl font-semibold">How it works</h2>
        <ol class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
          <li class="rounded-2xl border border-white/10 p-6 bg-white/[0.03]"><span class="text-white/60">Step 1</span><h3 class="mt-2 font-semibold">Set up Sanaa (1 day)</h3><p class="mt-2 text-white/70">Import products, add branches, and invite your team.</p></li>
          <li class="rounded-2xl border border-white/10 p-6 bg-white/[0.03]"><span class="text-white/60">Step 2</span><h3 class="mt-2 font-semibold">Launch channels & workflows</h3><p class="mt-2 text-white/70">Go live with POS, store, and BNPL flows that fit you.</p></li>
          <li class="rounded-2xl border border-white/10 p-6 bg-white/[0.03]"><span class="text-white/60">Step 3</span><h3 class="mt-2 font-semibold">Grow with insights & marketing</h3><p class="mt-2 text-white/70">See what works, finance growth, and keep customers coming back.</p></li>
        </ol>
      </div>
    </section>

    <!-- RESULTS / PROOF -->
    <section aria-labelledby="proof2" class="border-y border-white/10">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="proof2" class="text-2xl font-semibold">Results you can expect</h2>
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
          @foreach($c['kpis'] as $k)
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6 text-center font-semibold">{{ $k }}</div>
          @endforeach
        </div>
        <div class="mt-10">
          <div id="tslides" class="relative overflow-hidden rounded-2xl border border-white/10">
            <div id="ttrack" class="flex transition-transform duration-500">
              @foreach($c['testimonials'] as $t)
                <figure class="w-full shrink-0 p-8 bg-white/[0.02]">
                  <blockquote class="text-lg">“{{ $t['quote'] }}”</blockquote>
                  <figcaption class="mt-4 text-sm text-white/70">— {{ $t['name'] }}, {{ $t['role'] }}</figcaption>
                </figure>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TRUST & SECURITY -->
    <section aria-labelledby="trust">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="trust" class="text-2xl font-semibold">Trust & Security</h2>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <ul class="space-y-2 list-disc list-inside text-white/80">
            <li>Encryption at rest and in transit</li>
            <li>Role-based access control</li>
            <li>Audit logs and exports</li>
            <li>Regional hosting options</li>
            <li>Data portability—your data, anytime</li>
          </ul>
          <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
            <h3 class="font-semibold">Responsible BNPL</h3>
            <p class="mt-2 text-white/70">We enforce limits, approvals, and reminders to keep lending responsible. Device recovery and KYC workflows are built in.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- PRICING TEASER -->
    <section aria-labelledby="pricing" class="border-y border-white/10">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="pricing" class="text-2xl font-semibold">Start from <span class="text-emerald-400">UGX 150,000</span> / month</h2>
        <p class="mt-2 text-white/70">Plans for growing teams.</p>
        <div class="mt-6 flex gap-3">
          <a href="{{ route('prices') }}" class="inline-flex px-5 py-3 rounded-xl bg-emerald-500 text-black font-semibold hover:bg-emerald-400">See pricing</a>
          <a href="#sales" id="openSales3" class="inline-flex px-5 py-3 rounded-xl border border-white/20 text-white hover:bg-white/10">Talk to sales</a>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section aria-labelledby="faq">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 id="faq" class="text-2xl font-semibold">Frequently asked questions</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($c['faqs'] as $f)
            <details class="rounded-2xl border border-white/10 p-5 bg-white/[0.03]">
              <summary class="font-semibold cursor-pointer">{{ $f['q'] }}</summary>
              <p class="mt-2 text-white/70">{{ $f['a'] }}</p>
            </details>
          @endforeach
        </div>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section aria-labelledby="final" class="border-t border-white/10">
      <div class="max-w-7xl mx-auto px-6 py-16 text-center">
        <h2 id="final" class="text-3xl md:text-4xl font-semibold">Build your business the Sanaa way.</h2>
        <div class="mt-6 flex justify-center gap-3">
          <a href="#signup" data-cta="get-started" class="inline-flex items-center px-5 py-3 rounded-xl bg-emerald-500 text-black font-semibold hover:bg-emerald-400">Get started</a>
          <a href="#sales" id="openSales4" data-cta="contact-sales" class="inline-flex items-center px-5 py-3 rounded-xl border border-white/20 text-white hover:bg-white/10">Book a demo</a>
        </div>
      </div>
    </section>
  </main>

  <!-- Sales Modal -->
  <a id="sales" class="sr-only" aria-hidden="true" tabindex="-1">sales</a>
  <div id="salesModal" class="fixed inset-0 z-50 hidden" aria-hidden="true">
    <div class="absolute inset-0 bg-black/70" id="salesBackdrop"></div>
    <div class="relative max-w-lg mx-auto mt-28 bg-black border border-white/10 rounded-2xl overflow-hidden">
      <div class="p-5 border-b border-white/10 flex items-center justify-between">
        <h3 class="font-semibold">Talk to sales</h3>
        <button id="closeSales" class="p-2 hover:bg-white/10 rounded">✕</button>
      </div>
      <form method="POST" action="{{ route('contact.store') }}" class="p-5 space-y-4">
        @csrf
        <label class="block text-sm">Name
          <input name="name" required class="mt-1 w-full rounded-lg border border-white/20 bg-transparent p-2" />
        </label>
        <label class="block text-sm">Email
          <input name="email" type="email" required class="mt-1 w-full rounded-lg border border-white/20 bg-transparent p-2" />
        </label>
        <label class="block text-sm">Message
          <textarea name="message" rows="4" class="mt-1 w-full rounded-lg border border-white/20 bg-transparent p-2"></textarea>
        </label>
        <div class="flex justify-end gap-3">
          <button type="button" id="closeSales2" class="px-4 py-2 rounded-lg border border-white/20">Cancel</button>
          <button class="px-4 py-2 rounded-lg bg-emerald-500 text-black font-semibold">Send</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Sticky header
    const head = document.getElementById('siteHeader');
    const onScroll = () => {
      if (window.scrollY > 10) head.classList.add('sticky-head','bg-black/70');
      else head.classList.remove('sticky-head','bg-black/70');
    };
    document.addEventListener('scroll', onScroll); onScroll();

    // Tabs
    document.querySelectorAll('[data-tab]').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('[role="tab"]').forEach(b=>{b.setAttribute('aria-selected','false');b.classList.remove('bg-white/10');});
        btn.setAttribute('aria-selected','true'); btn.classList.add('bg-white/10');
        document.querySelectorAll('.industry-panel').forEach(p=>p.classList.add('hidden'));
        document.getElementById(btn.dataset.tab)?.classList.remove('hidden');
      });
    });

    // Testimonials slider
    const track = document.getElementById('ttrack');
    let idx = 0; setInterval(()=>{ idx=(idx+1)%{{ count($c['testimonials']) }}; track.style.transform=`translateX(-${idx*100}%)`; }, 5000);

    // Sales modal
    const modal = document.getElementById('salesModal');
    const openers = ['openSales','openSales2','openSales3','openSales4'].map(id=>document.getElementById(id));
    const closers = [document.getElementById('closeSales'),document.getElementById('closeSales2'),document.getElementById('salesBackdrop')];
    openers.forEach(b=>b&&b.addEventListener('click',()=>{modal.classList.remove('hidden'); modal.setAttribute('aria-hidden','false');}));
    closers.forEach(b=>b&&b.addEventListener('click',()=>{modal.classList.add('hidden'); modal.setAttribute('aria-hidden','true');}));
  </script>
</body>
</html>
