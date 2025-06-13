@extends('layouts.landing')

@section('content')
  <div class="body">
    <div role="main" class="main">
      <!-- Hero Section -->
      <section id="hero" class="bg-black text-white flex items-center justify-center min-h-[70vh] px-4">
        <div class="text-center space-y-6">
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight">
            Building the future of African commerce
          </h1>
          <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto">
            Our mission is to empower businesses with modern digital infrastructure for payments, media and commerce.
          </p>
          <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#services" class="bg-white text-black font-semibold px-8 py-3 rounded-md hover:bg-gray-200 transition">Explore Sanaa</a>
            <a href="https://soko.sanaa.co" target="_blank" class="border border-white px-8 py-3 rounded-md hover:bg-white hover:text-black transition">Shop on Soko 24</a>
          </div>
        </div>
      </section>

      <!-- Sanaa OS/ERP Section -->
    <section id="services" class="section section-height-3 bg-primary border-0 m-0 appear-animation" data-appear-animation="fadeIn">
      <div class="container my-3">
        <div class="row mb-5">
          <div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
            <h2 class="text-2xl font-weight-bold text-color-black mb-2">Sanaa OS/ERP</h2>
          </div>
        </div>
        <div class="row mb-lg-4">
          <div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
            <div class="feature-box feature-box-style-2">
              <div class="feature-box-icon"></div>
              <div class="feature-box-info">
                <h4 class="font-weight-bold text-color-black text-4 mb-2">SOKO 24</h4>
                <p class="text-color-black opacity-7">
                  Our online shopping destination features authentic brands, everyday essentials, beauty/personal care items, and cutting-edge gadgets. Our e-commerce platform strives to redefine the shopping experience by focusing on value addition and supply chain innovation.
                </p>
                <a href="https://soko.sanaa.co" target="_blank" class="inline-block mt-3 px-4 py-2 bg-white text-black rounded shadow hover:bg-gray-100 transition">Visit Soko 24</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter">
            <div class="feature-box feature-box-style-2">
              <div class="feature-box-icon"></div>
              <div class="feature-box-info">
                <h4 class="font-weight-bold text-color-black text-4 mb-2">SANAA Fi.</h4>
                <p class="text-color-black opacity-7">
                  Provide the simplest and most reliable financial solution for businesses across Africa. From receiving payments to accessing credit. Sanaa Fi aims to simplify the way businesses manage their finances in Africa.
                </p>
                <a href="https://fin.sanaa.co" target="_blank" class="inline-block mt-3 px-4 py-2 bg-white text-black rounded shadow hover:bg-gray-100 transition">Visit Sanaa Fin</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
            <div class="feature-box feature-box-style-2">
              <div class="feature-box-icon"></div>
              <div class="feature-box-info">
                <h4 class="font-weight-bold text-color-black text-4 mb-2">SANAA MEDIA</h4>
                <p class="text-color-black opacity-7">
                  Serving African content creators by enabling them to build fully digital media brands ready to bridge the gap between the world's youngest continent, still primarily served by traditional media.
                </p>
                <a href="https://media.sanaa.co" target="_blank" class="inline-block mt-3 px-4 py-2 bg-white text-black rounded shadow hover:bg-gray-100 transition">Visit Sanaa Media</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
            <div class="feature-box feature-box-style-2">
              <div class="feature-box-icon"></div>
              <div class="feature-box-info">
                <h4 class="font-weight-bold text-color-black text-4 mb-2">Oyes</h4>
                <p class="text-color-black opacity-7">
                  Logistics service for the delivery of goods from and through a network of local partners, suppliers on our various marketplaces. The goal being to solve one of the biggest logistical hurdles that hinder the e-commerce industry on the continent.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter">
            <div class="feature-box feature-box-style-2">
              <div class="feature-box-icon"></div>
              <div class="feature-box-info">
                <h4 class="font-weight-bold text-color-black text-4 mb-2">WOO +</h4>
                <p class="text-color-black opacity-7">
                  WOO+ is a line of digital media player software programs developed by Sanaa aimed at subscription-based streaming services that allow members to watch high-quality, Original African TV shows and movies, <br>ad-free, on Internet-connected devices.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
            <div class="feature-box feature-box-style-2">
              <div class="feature-box-icon">
                <i class="icons icon-screen-paypal text-color-black"></i>
              </div>
              <div class="feature-box-info">
                <h4 class="font-weight-bold text-color-black text-4 mb-2">ilé</h4>
                <p class="text-color-black opacity-7">
                  Online real estate marketplace where tenants & owners meet to find properties for sale or rent. Properties ranging from houses, apartments, building plots, garages, offices, shops and industrial premises, from new constructions to exceptional historical buildings in Africa.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Meet the Team</h2>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="text-center">
            <img src="/img/placeholder-team.jpg" alt="Aguma I. Banks" class="w-32 h-32 rounded-full mx-auto mb-4">
            <h3 class="text-xl font-semibold">Aguma I. Banks</h3>
            <p class="text-gray-600">Founder &amp; CEO</p>
          </div>
          <!-- Additional team members can be added here -->
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


    <!-- Latest Blog Posts -->
    <section class="py-16 bg-gray-100">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Latest from our blog</h2>
        <div class="grid md:grid-cols-3 gap-8">
          @foreach(\App\Models\Blog::orderByDesc('created_at')->take(3)->get() as $blog)
          <div class="bg-white rounded-lg shadow hover:shadow-md transition">
            @if($blog->image)
            <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover rounded-t-lg">
            @endif
            <div class="p-4">
              <h3 class="text-xl font-semibold mb-2">
                <a href="{{ route('blog.show', $blog->slug) }}" class="hover:underline">{{ $blog->title }}</a>
              </h3>
              <p class="text-sm text-gray-700">{{ $blog->excerpt }}</p>
            </div>
          </div>
          @endforeach
        </div>
        <div class="text-center mt-8">
          <a href="{{ route('blog.index') }}" class="btn btn-primary">View all posts</a>
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
</script>
@endpush

@push('styles')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

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
</style>
@endpush