@extends('layouts.landing')

@section('title', 'Home | ' . config('app.name'))

@section('content')
  <div class="body">
    <div role="main" class="main">
      <!-- Hero Section -->
      <section id="hero" class="relative flex items-center justify-center min-h-[70vh] overflow-hidden px-4">
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
          <source src="/videos/hero-video.mp4" type="video/mp4">
          <!-- Fallback for when video fails to load -->
          <div class="absolute inset-0 bg-gradient-to-br from-green-900 via-gray-900 to-black"></div>
        </video>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center space-y-6">
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-white">
            Building the future we want
          </h1>
          <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
            Our mission is to empower businesses with modern digital infrastructure for payments, media and commerce.
          </p>
          <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#services" class="btn-cta">Explore Sanaa</a>
            <a href="https://soko.sanaa.co" target="_blank" class="btn-cta-outline">Shop on Soko 24</a>
          </div>
        </div>
      </section>

<section id="services" class="py-16 bg-gray-100 dark:bg-gray-900">
  <div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold text-center mb-10">Sanaa Products & Services</h2>
    <div class="grid gap-8 md:grid-cols-3">
      @forelse(\App\Models\Offering::latest()->take(3)->get() as $offering)
        <div class="group relative bg-white dark:bg-gray-800 rounded-lg p-8 shadow-sm hover:shadow-lg transition overflow-hidden">
          <div class="mb-4 text-green-600 text-4xl">
            <i class="fas fa-cube"></i>
          </div>
          <h4 class="font-bold text-lg mb-2">{{ $offering->title }}</h4>
          <p class="text-sm opacity-70">{{ $offering->description }}</p>
          @if($offering->link)
            <a href="{{ $offering->link }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black/80 text-white opacity-0 group-hover:opacity-100 transition">Learn More</a>
          @endif
        </div>
      @empty
        <div class="text-center col-span-3 text-gray-600 dark:text-gray-300">Offerings will be added soon.</div>
      @endforelse
    </div>
  </div>
</section>




    <!-- Team Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Meet the Team</h2>
        <div class="grid md:grid-cols-3 gap-8">
          @foreach($teamMembers as $member)
          <div class="relative text-center group" tabindex="0" aria-label="More about {{ $member->name }}">
            @if($member->photo)
            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-32 h-32 rounded-full mx-auto mb-4 grayscale group-hover:grayscale-0 group-focus:grayscale-0 transition" loading="lazy">
            @endif
            <h3 class="text-xl font-semibold">{{ $member->name }}</h3>
            @if($member->title)
            <p class="text-gray-600 dark:text-gray-300">{{ $member->title }}</p>
            @endif
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/80 text-white text-sm rounded-full opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition">
              @if($member->title)
              <span class="font-semibold">{{ $member->title }}</span>
              @endif
              @if($member->bio)
              <p class="px-4 mt-1">{{ $member->bio }}</p>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

  
    
    <!-- Soko Products Section -->
<section id="soko-products" class="section py-5 border-0 m-0 appear-animation" data-appear-animation="fadeIn">
  <div class="container my-5">
    <div class="row mb-5">
      <div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
        <h2 class="text-3xl font-weight-bold mb-3">Featured Products</h2>
        <p class="text-lg opacity-7 max-w-lg mx-auto">Discover our selection of quality products from Soko 24</p>
        <div class="divider-small divider-small-center my-3">
          <hr class="bg-primary">
        </div>
      </div>
    </div>
    
    <!-- Products Loading State -->
    <div id="products-loading" class="row">
      @for ($i = 0; $i < 8; $i++)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="product-skeleton h-100">
            <div class="skeleton-img" style="height: 200px;"></div>
            <div class="skeleton-content p-3">
              <div class="skeleton-title mb-2"></div>
              <div class="skeleton-price"></div>
              <div class="skeleton-button mt-3"></div>
            </div>
          </div>
        </div>
      @endfor
    </div>
    
    <!-- Products Container -->
    <div class="row" id="product-container" style="display: none;">
      @if(isset($sokoProducts['data']) && count($sokoProducts['data']) > 0)
        @foreach(array_slice($sokoProducts['data'], 0, 8) as $product)
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product-card" data-product-id="{{ $product['id'] }}" tabindex="0" role="button" aria-label="View details for {{ $product['name'] }}">
              <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden">
                <div class="position-relative">
                  <div class="product-image-container d-block overflow-hidden" style="height: 200px;">
                    <img src="{{ $product['thumbnail_image'] }}" class="card-img-top" alt="{{ $product['name'] }}" 
                         style="object-fit: cover; width: 100%; height: 100%;" loading="lazy"
                         onerror="this.src='/img/placeholder-product.jpg'; this.alt='Product image unavailable';">
                  </div>
                  @if($product['has_discount'])
                    <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px; font-size: 0.8rem; padding: 6px 10px;">
                      {{ $product['discount'] }}
                    </span>
                  @endif
                </div>
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title font-weight-bold text-truncate mb-2" style="font-size: 1rem;">
                    {{ $product['name'] }}
                  </h5>
                  <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                    <p class="card-text font-weight-bold mb-0 text-primary" style="font-size: 1.1rem;">
                      {{ str_replace('/=', '', $product['main_price']) }}
                    </p>
                    @if($product['has_discount'])
                      <p class="card-text mb-0 text-muted text-decoration-line-through" style="font-size: 0.9rem;">
                        {{ str_replace('/=', '', $product['stroked_price']) }}
                      </p>
                    @endif
                  </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                  <button class="btn btn-primary btn-sm px-4 quick-view-btn">
                    <i class="fas fa-eye mr-1"></i> Quick View
                  </button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
          <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i> No products found.
          </div>
        </div>
      @endif
    </div>
    
    <div class="row mt-5">
      <div class="col text-center">
        <a href="https://soko.sanaa.co" class="btn btn-primary btn-lg px-5 py-2 shadow-sm" target="_blank">
          <i class="fas fa-shopping-cart mr-2"></i> Visit Soko 24
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Product Modal -->
<div id="productModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 rounded-lg shadow-lg overflow-hidden">
      <!-- Modal Loading State -->
      <div id="modal-loading" class="p-5 text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <p class="mt-3 text-muted">Loading product details...</p>
      </div>
      
      <!-- Modal Content -->
      <div id="modal-content" style="display: none;">
        <div class="modal-header border-bottom-0 pb-0">
          <h5 class="modal-title font-weight-bold" id="modalProductName"></h5>
          <button type="button" class="close close-modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body pt-3">
          <div class="row">
            <div class="col-md-6">
              <!-- Product Images Slider -->
              <div id="modalSliderContainer" class="product-slider mb-3 mb-md-0">
                <div class="swiper-container">
                  <div class="swiper-wrapper" id="modalSliderWrapper"></div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
              </div>
              
              <!-- Single Product Image (Fallback) -->
              <div id="modalSingleImage" class="d-none">
                <img id="modalThumbnail" src="" alt="" class="img-fluid rounded shadow-sm" loading="lazy">
              </div>
            </div>
            
            <div class="col-md-6">
              <!-- Product Details -->
              <div class="product-details">
                <div class="product-price mb-3">
                  <h4 id="modalPrice" class="text-primary font-weight-bold mb-1"></h4>
                  <div id="modalDiscountContainer" class="d-none">
                    <span id="modalDiscountPrice" class="text-muted text-decoration-line-through mr-2"></span>
                    <span id="modalDiscountBadge" class="badge badge-danger"></span>
                  </div>
                </div>
                
                <div id="modalProductDescription" class="product-description mb-4"></div>
                
                <div class="product-actions mt-4">
                  <a href="#" id="modalViewProductLink" class="btn btn-primary btn-lg" target="_blank">
                    View on Soko <i class="fas fa-external-link-alt ml-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal-footer bg-light border-top-0">
          <div class="container-fluid">
            <div class="row align-items-center">
              <div class="col-md-8 text-md-left text-center mb-2 mb-md-0">
                <small class="text-muted">Powered by <strong>Soko 24</strong> - Sanaa's e-commerce platform</small>
              </div>
              <div class="col-md-4 text-md-right text-center">
                <button type="button" class="btn btn-sm btn-secondary close-modal">
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal Error State -->
      <div id="modal-error" class="p-5 text-center" style="display: none;">
        <div class="text-danger mb-3">
          <i class="fas fa-exclamation-circle fa-3x"></i>
        </div>
        <h5 class="text-danger">Unable to Load Product</h5>
        <p class="text-muted mb-4" id="modal-error-message">An error occurred while loading product details.</p>
        <button type="button" class="btn btn-outline-primary close-modal">
          Close
        </button>
      </div>
  </div>
</div>
</div>


    <!-- Latest Blog Posts (Premium) -->
<!-- Latest Blog Posts (Ultra-Premium MacBook Pro Inspired) -->
<section id="latest-blog-premium" class="relative py-40 bg-black overflow-hidden">
  <!-- Ambient lighting (standard utilities only) -->
  <div aria-hidden="true" class="pointer-events-none absolute inset-0">
    <!-- Primary light source -->
    <div
      class="absolute -top-80 left-1/2 -translate-x-1/2 w-full max-w-7xl aspect-square rounded-full blur-3xl opacity-10
             bg-gradient-conic from-emerald-400 via-cyan-400 to-lime-300">
    </div>

    <!-- Secondary accent lights -->
    <div
      class="absolute top-1/4 -left-40 w-full max-w-xl aspect-square rounded-full blur-3xl opacity-10
             bg-gradient-radial from-emerald-400/20 to-transparent">
    </div>
    <div
      class="absolute bottom-1/4 -right-40 w-full max-w-xl aspect-square rounded-full blur-3xl opacity-10
             bg-gradient-radial from-cyan-400/20 to-transparent">
    </div>

    <!-- Subtle texture overlay (removed data-URI noise; keep blend for softness) -->
    <div class="absolute inset-0 opacity-5 mix-blend-soft-light"></div>
  </div>

  <div class="container mx-auto px-6 pt-8 relative">
    <!-- Header -->
    <div class="text-center max-w-5xl mx-auto mb-24">
      <div class="inline-flex items-center px-5 py-2.5 rounded-full text-xs font-semibold tracking-widest uppercase
                  bg-white/5 text-gray-300 border border-white/10 backdrop-blur-xl mb-8
                  hover:bg-white/10 hover:border-white/20 transition-all duration-500 shadow-lg">
        <span class="w-2 h-2 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full mr-4 animate-pulse"></span>
        Latest Stories
      </div>

      <h2 class="text-6xl md:text-7xl font-semibold tracking-tight text-white mb-8 leading-none"
          style="font-family: 'SF Pro Display', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;">
        From our blog
      </h2>

      <p class="text-xl text-gray-400 font-medium leading-relaxed max-w-3xl mx-auto tracking-tight"
         style="font-family: 'SF Pro Text', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;">
        Thoughtful stories on building, design and technology that shape tomorrow's digital landscape.
      </p>
    </div>

    <!-- Blog carousel -->
    <div class="relative">
      <div class="swiper blog-swiper">
        <div class="swiper-wrapper pb-4 pt-4">
          @foreach(\App\Models\Blog::published()->orderByDesc('published_at')->orderByDesc('created_at')->take(6)->get() as $blog)
          <div class="swiper-slide h-auto ">
            <article
              class="group relative p-4 overflow-hidden rounded-3xl bg-white/5 backdrop-blur-2xl border border-white/10
                     shadow-2xl flex flex-col h-full
                     hover:bg-white/10 hover:border-white/20 hover:shadow-2xl transition-all duration-500 ease-out hover:scale-105 hover:-translate-y-2">

              <!-- Glass overlays -->
              <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-white/10 via-white/5 to-white/10 pointer-events-none opacity-60"></div>
              <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-black/5 via-transparent to-white/5 pointer-events-none"></div>

              <!-- Edge highlight -->
              <div class="absolute inset-px rounded-3xl bg-gradient-to-b from-white/10 via-transparent to-transparent pointer-events-none opacity-40"></div>

              <!-- Image -->
              <div class="relative aspect-video overflow-hidden rounded-t-3xl">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 via-transparent to-cyan-500/10 z-10"></div>

                <!-- <img src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" loading="lazy"
                     class="absolute inset-0 h-full w-full object-cover transition-all duration-1000 ease-out
                            group-hover:scale-110 group-hover:brightness-110 group-hover:contrast-125 group-hover:saturate-150"/> -->

                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-20"></div>

                @if($blog->category)
                <a href="{{ route('blog.category', $blog->category->slug) }}"
                   class="absolute left-7 bottom-7 inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold tracking-wide
                          bg-white/20 text-white border border-white/30 backdrop-blur-2xl
                          hover:bg-white/30 hover:border-white/40 transition-all duration-300 z-30 shadow-md hover:shadow-lg hover:scale-105 hover:-translate-y-0.5">
                  <span class="w-2 h-2 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full mr-3"></span>
                  {{ $blog->category->name }}
                </a>
                @endif
              </div>

              <!-- Content -->
              <div class="p-9 flex flex-col flex-1 relative z-10">
                <h3 class="text-2xl md:text-3xl font-semibold text-white leading-snug mb-5 group-hover:text-emerald-400 transition-colors duration-300 tracking-tight"
                    style="font-family: 'SF Pro Display', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;">
                  <a href="{{ $blog->url }}" class="focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/60 rounded-2xl block -m-2 p-2">
                    {{ $blog->title }}
                  </a>
                </h3>

                <p class="text-gray-400 line-clamp-3 leading-relaxed mb-8 flex-1 font-medium tracking-tight"
                   style="font-family: 'SF Pro Text', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;">
                  {{ $blog->excerpt }}
                </p>

                <div class="flex items-center justify-between pt-6 border-t border-white/10">
                  <div class="flex items-center gap-4 pr-2 text-xs text-gray-500">
                    <!-- <div class="flex items-center gap-3">
                      <div class="w-7 h-7 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-[11px] font-bold text-black">
                        {{ strtoupper(substr($blog->author->name ?? 'S', 0, 1)) }}
                      </div>
                      <span class="font-medium text-gray-400">{{ $blog->author->name ?? 'Sanaa Team' }}</span>
                    </div> -->
                    <!-- <span aria-hidden="true" class="text-gray-600/60">•</span> -->
                    <time datetime="{{ ($blog->published_at ?? $blog->created_at)->toDateString() }}" class="font-medium text-gray-500">
                      {{ $blog->formatted_date }}
                    </time>
                    <!-- <span aria-hidden="true" class="text-gray-600/60">•</span>
                    <span class="font-medium text-gray-500">{{ $blog->reading_time }} min</span> -->
                  </div>

                  <a href="{{ $blog->url }}"
                     class="inline-flex items-center gap-2.5 px-3 py-2.5 rounded-md bg-white/5 hover:bg-emerald-500/20 text-gray-300 hover:text-emerald-400
                            border border-white/10 hover:border-emerald-500/30 transition-all duration-300 text-xs font-semibold
                            backdrop-blur-xl hover:shadow-lg group tracking-wide hover:scale-105 hover:-translate-y-0.5">
                    Read story
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1 opacity-80" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                      <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </article>
          </div>
          @endforeach
        </div>

        <!-- Navigation -->
        <button
          class="blog-swiper-button-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 w-14 h-14 rounded-full bg-black/40 backdrop-blur-2xl
                 border border-white/10 text-white/70 hover:text-white hover:bg-black/60 hover:border-white/20 hover:shadow-xl
                 transition-all duration-300 flex items-center justify-center hover:scale-110 hover:-translate-x-1"
          aria-label="Previous">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="m10.828 12 4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z"/>
          </svg>
        </button>
        <button
          class="blog-swiper-button-next absolute right-6 top-1/2 -translate-y-1/2 z-20 w-14 h-14 rounded-full bg-black/40 backdrop-blur-2xl
                 border border-white/10 text-white/70 hover:text-white hover:bg-black/60 hover:border-white/20 hover:shadow-xl
                 transition-all duration-300 flex items-center justify-center hover:scale-110 hover:translate-x-1"
          aria-label="Next">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- CTA -->
    <div class="text-center mt-24">
      <a href="{{ route('blog.index') }}"
         class="inline-flex items-center justify-center px-10 py-5 rounded-md bg-gradient-to-r from-emerald-500 via-emerald-400 to-emerald-600
                hover:from-emerald-400 hover:via-emerald-400 hover:to-emerald-500 text-black font-semibold shadow-2xl
                hover:shadow-2xl hover:scale-105 hover:-translate-y-1 transition-all duration-500 text-base
                backdrop-blur-sm border border-emerald-400/30 hover:border-emerald-300/50 relative overflow-hidden group tracking-tight">
        <span class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/30 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out"></span>
        <span class="relative. test-white">View all stories</span>
        <svg class="h-5 w-5 ml-3 relative transition-transform duration-300 group-hover:translate-x-2 opacity-90" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
        </svg>
      </a>
    </div>
  </div>
</section>



    <!-- Join Section -->
    <section class="bg-black text-white py-20" style="font-family: 'Montserrat', sans-serif;">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-semibold leading-tight text-white">
          Join the 400 + businesses running <br class="hidden md:block" /> with Sanaa.<sup class="align-super text-sm">*</sup>
        </h1>
        <div class="mt-8 flex justify-center space-x-4 py-4">
          <a href="#" class="inline-block border border-blue-600 text-white px-6 py-2 rounded hover:bg-blue-600 hover:text-white transition-colors">Get started</a>
          <a href="#" class="inline-block bg-primary text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors">Contact sales</a>
        </div>
        <p class="mt-6 text-sm text-gray-400">*Source: Q1 2023 Earnings Report Shareholder Letter</p>
      </div>
    </section>

   
  </div>
</div>
@endsection

@push('scripts')
<!-- External Dependencies -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}"></script>

<script>
// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
  const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
  const mobileMenu = document.getElementById('mobile-menu');
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
      const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
      mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
      mobileMenu.classList.toggle('hidden');
    });
  }
});

// Google Maps Initialization
function initializeGoogleMaps() {
  var mapMarkers = [{
    address: "Sanaa Brands LTD, Nasser Rd, Kampala",
    html: "<strong>Sanaa Brands LTD, </strong><br>Nasser Rd, Kampala<br><br><a href='#' onclick='mapCenterAt({latitude: 0.31077238305742366, longitude: 32.58389732826509, zoom: 16}, event)'>[+] zoom here</a>",
    icon: {
      image: "img/pin.png",
      iconsize: [26, 46],
      iconanchor: [12, 46]
    }
  }];

  var initLatitude = 0.31077238305742366;
  var initLongitude = 32.58389732826509;

  var mapSettings = {
    controls: {
      draggable: (($.browser && $.browser.mobile) ? false : true),
      panControl: true,
      zoomControl: true,
      mapTypeControl: true,
      scaleControl: true,
      streetViewControl: true,
      overviewMapControl: true
    },
    scrollwheel: false,
    markers: mapMarkers,
    latitude: initLatitude,
    longitude: initLongitude,
    zoom: 13
  };

  var map = $('#googlemaps').gMap(mapSettings),
      mapRef = $('#googlemaps').data('gMap.reference');

  var styles = [
    {"featureType": "water","elementType": "geometry","stylers": [{"color": "#e9e9e9"},{"lightness": 17}]},
    {"featureType": "landscape","elementType": "geometry","stylers": [{"color": "#f5f5f5"},{"lightness": 20}]},
    {"featureType": "road.highway","elementType": "geometry.fill","stylers": [{"color": "#ffffff"},{"lightness": 17}]},
    {"featureType": "road.highway","elementType": "geometry.stroke","stylers": [{"color": "#ffffff"},{"lightness": 29},{"weight": 0.2}]},
    {"featureType": "road.arterial","elementType": "geometry","stylers": [{"color": "#ffffff"},{"lightness": 18}]},
    {"featureType": "road.local","elementType": "geometry","stylers": [{"color": "#ffffff"},{"lightness": 16}]},
    {"featureType": "poi","elementType": "geometry","stylers": [{"color": "#f5f5f5"},{"lightness": 21}]},
    {"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#dedede"},{"lightness": 21}]},
    {"elementType": "labels.text.stroke","stylers": [{"visibility": "on"},{"color": "#ffffff"},{"lightness": 16}]},
    {"elementType": "labels.text.fill","stylers": [{"saturation": 36},{"color": "#333333"},{"lightness": 40}]},
    {"elementType": "labels.icon","stylers": [{"visibility": "off"}]},
    {"featureType": "transit","elementType": "geometry","stylers": [{"color": "#f2f2f2"},{"lightness": 19}]},
    {"featureType": "administrative","elementType": "geometry.fill","stylers": [{"color": "#fefefe"},{"lightness": 20}]},
    {"featureType": "administrative","elementType": "geometry.stroke","stylers": [{"color": "#fefefe"},{"lightness": 17},{"weight": 1.2}]}
  ];
  var styledMap = new google.maps.StyledMapType(styles, { name: 'Styled Map' });
  mapRef.mapTypes.set('map_style', styledMap);
  mapRef.setMapTypeId('map_style');
}

theme.fn.intObs('.google-map', 'initializeGoogleMaps()', {});

// Map centerAt function
var mapCenterAt = function(options, e) {
  e.preventDefault();
  $('#googlemaps').gMap("centerAt", options);
}

// Product Modal & Slider
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('productModal');
  const modalProductName = document.getElementById('modalProductName');
  const modalThumbnail = document.getElementById('modalThumbnail');
  const modalProductDescription = document.getElementById('modalProductDescription');
  const closeModal = document.querySelector('.close-modal');
  const modalSliderContainer = document.getElementById('modalSliderContainer');
  const modalSliderWrapper = document.getElementById('modalSliderWrapper');

  async function openProductModal(productId) {
    try {
      const response = await fetch(`https://soko.sanaa.co/api/v2/products/${productId}`);
      if (!response.ok) throw new Error(`Network error: ${response.status}`);
      const data = await response.json();
      if (data.success && data.data && data.data.length > 0) {
        const product = data.data[0];
        modalProductName.textContent = product.name;
        modalProductDescription.innerHTML = product.description;
        modal.setAttribute('aria-hidden', 'false');
        if (product.photos && product.photos.length > 1) {
          modalSliderContainer.style.display = 'block';
          modalThumbnail.style.display = 'none';
          modalSliderWrapper.innerHTML = '';
          product.photos.forEach((photo, index) => {
            const slide = document.createElement('div');
            slide.className = 'swiper-slide';
            const img = document.createElement('img');
            img.src = photo.path;
            img.alt = `${product.name} - Image ${index + 1}`;
            img.loading = 'lazy';
            img.style.width = '100%';
            img.style.objectFit = 'contain';
            slide.appendChild(img);
            modalSliderWrapper.appendChild(slide);
          });
          if (window.modalSwiper) {
            window.modalSwiper.update();
          } else {
            window.modalSwiper = new Swiper('#modalSliderContainer .swiper-container', {
              loop: true,
              autoplay: { delay: 4000, disableOnInteraction: true },
              pagination: { el: '#modalSliderContainer .swiper-pagination', clickable: true },
              navigation: {
                nextEl: '#modalSliderContainer .swiper-button-next',
                prevEl: '#modalSliderContainer .swiper-button-prev'
              },
              spaceBetween: 10,
              speed: 600
            });
          }
        } else {
          modalSliderContainer.style.display = 'none';
          modalThumbnail.style.display = 'block';
          modalThumbnail.src = product.thumbnail_image;
          modalThumbnail.alt = product.name;
          modalThumbnail.loading = 'lazy';
        }
        modal.classList.add('show');
        modal.style.display = 'flex';
        closeModal.focus();
      } else {
        alert('No product details found.');
      }
    } catch (error) {
      console.error('Error:', error);
      alert('Failed to load product details.');
    }
  }

  closeModal.addEventListener('click', function() {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = 'none';
      modal.setAttribute('aria-hidden', 'true');
    }, 300);
  });

  closeModal.addEventListener('keydown', function(event) {
    if (event.key === 'Enter' || event.key === ' ') {
      modal.classList.remove('show');
      setTimeout(() => {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
      }, 300);
    }
  });

  modal.addEventListener('click', function(event) {
    if (event.target === modal) {
      modal.classList.remove('show');
      setTimeout(() => {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
      }, 300);
    }
  });

  document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', function() {
      const productId = this.getAttribute('data-product-id');
      openProductModal(productId);
    });
  });
});

// Duplicate Swiper initialization removed - using the premium one in the blog section instead
</script>
@endpush

@push('styles')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- SF Pro Fonts for Premium Blog Section -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;450;500;600;650;700&display=swap" rel="stylesheet">

<style>
  /* Product card hover effect */
  .product-card .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .product-card .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
  }
  .product-card .card-img-top {
    transition: transform 0.3s ease;
  }
  .product-card .card:hover .card-img-top {
    transform: scale(1.05);
  }
  /* Button styling */
  .btn-success {
    background-color: #28a745;
    border: none;
    transition: background-color 0.3s ease;
  }
  .btn-success:hover {
    background-color: #218838;
  }
  /* Modal styling */
  #productModal {
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  #productModal.show {
    opacity: 1;
  }
  #productModal .modal-content {
    max-width: 800px;
    width: 90%;
    padding: 25px;
    border-radius: 12px;
  }
  /* Swiper slider styling */
  .swiper-pagination-bullet {
    background: #000;
    opacity: 0.7;
  }
  .swiper-pagination-bullet-active {
    opacity: 1;
  }
  .swiper-button-next, .swiper-button-prev {
    color: #000;
    transition: opacity 0.3s ease;
  }
  .swiper-button-next:hover, .swiper-button-prev:hover {
    opacity: 0.8;
  }
  .swiper-slide img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
  }
  /* Responsive adjustments */
  @media (max-width: 768px) {
    #productModal .modal-content {
      width: 95%;
      padding: 15px;
    }
    #modalSliderContainer, #modalThumbnail {
      max-height: 300px;
    }
  }
  /* Line clamp helper if Tailwind plugin not available */
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  
  /* Ensure premium blog section styles take precedence */
  #latest-blog-premium .swiper-slide {
    height: auto !important;
  }
  
  /* Fix any potential z-index conflicts */
  #latest-blog-premium {
    position: relative;
    z-index: 1;
  }
</style>
@endpush
