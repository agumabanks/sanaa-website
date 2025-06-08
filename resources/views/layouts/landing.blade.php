<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sanaa Co.</title>

        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="facebook-domain-verification" content="9sz4w1uhc1h5znmxytx5h8d9ub838m" />

 
		<meta name="keywords" content="Sanaa Co.,Sanaa Brands, soko.ug, soko 24, soko ug,kampala,nasser road, museveni, sanaa, sanaa media, oyes, aguma banks, sanaa finance, sanaa pay, uganda, east africa entreprenuers, jumia, jiji, bank of ugada, aguma ibrahim, aguma banks, king Ceasor" />
		<meta name="description" content="Sanaa Co. building digital infrastructure solutions, Value addition and supply chain for small, medium and large busineses in Africa.">
		<meta name="author" content="Aguma Banks">
		
		   <!-- Subcompany Links for SEO -->
            <link rel="alternate" hreflang="en" href="https://soko.sanaa.co/">
            <link rel="alternate" hreflang="en" href="https://sanaamedia.com">
            <link rel="alternate" hreflang="en" href="https://fi.sanaa.co">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('storage/images/sanaa.png') }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ asset('storage/images/sanaa.png') }}">

		<style>
            body {
                font-family: 'Montserrat', sans-serif !important;
            }
        </style>




<!-- soko css -->
 <!-- Add these styles to your styles section -->
<style>
/* Product section styling */
#soko-products {
  background-color: #f8f9fa;
  position: relative;
  padding-top: 3rem;
  padding-bottom: 3rem;
}

#soko-products::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 6px;
  background: linear-gradient(90deg, #f8f9fa 0%, var(--primary, #0275d8) 50%, #f8f9fa 100%);
}

.divider-small {
  width: 80px;
  margin: 0 auto;
}

.divider-small hr {
  width: 100%;
  height: 3px;
  background: var(--primary, #0275d8);
  border: none;
  border-radius: 3px;
}

/* Product card styling */
.product-card {
  cursor: pointer;
  transition: all 0.3s ease;
}

.product-card .card {
  transition: transform 0.4s ease, box-shadow 0.4s ease;
  will-change: transform;
  border-radius: 12px;
  height: 100%;
}

.product-card .card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
}

.product-image-container {
  overflow: hidden;
  position: relative;
}

.product-card .card-img-top {
  transition: transform 0.5s ease;
  will-change: transform;
}

.product-card .card:hover .card-img-top {
  transform: scale(1.08);
}

.product-card .card-footer {
  border-top: 1px solid rgba(0,0,0,0.05);
  transition: background-color 0.3s ease;
}

.product-card .card:hover .card-footer {
  background-color: rgba(0,0,0,0.02);
}

.badge-danger {
  background-color: #dc3545;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
  }
  70% {
    box-shadow: 0 0 0 6px rgba(220, 53, 69, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
  }
}

/* Button styling */
.btn-primary {
  border: none;
  font-weight: 500;
  letter-spacing: 0.3px;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(2, 117, 216, 0.3);
}

.btn-primary::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 120%;
  height: 0;
  padding-bottom: 120%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transform: translate(-50%, -50%) scale(0);
  opacity: 0;
  transition: transform 0.5s, opacity 0.3s;
}

.btn-primary:active::after {
  transform: translate(-50%, -50%) scale(1);
  opacity: 1;
  transition: 0s;
}

/* Skeleton loading */
.product-skeleton {
  border-radius: 12px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.skeleton-img {
  background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
  background-size: 200% 100%;
  animation: shine 1.5s linear infinite;
  border-radius: 8px 8px 0 0;
}

.skeleton-content {
  padding: 15px;
}

.skeleton-title {
  height: 20px;
  background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
  background-size: 200% 100%;
  animation: shine 1.5s linear infinite;
  border-radius: 4px;
  margin-bottom: 15px;
}

.skeleton-price {
  height: 24px;
  width: 60%;
  background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
  background-size: 200% 100%;
  animation: shine 1.5s linear infinite;
  border-radius: 4px;
}

.skeleton-button {
  height: 36px;
  background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
  background-size: 200% 100%;
  animation: shine 1.5s linear infinite;
  border-radius: 4px;
  margin-top: 15px;
}

@keyframes shine {
  to {
    background-position-x: -200%;
  }
}

/* Modal styling */
.modal-content {
  border: none;
  border-radius: 12px;
  overflow: hidden;
}

.modal-header {
  border-bottom: 0;
  padding-bottom: 0;
}

.modal-footer {
  border-top: 0;
  background: #f8f9fa;
}

.close {
  transition: transform 0.3s ease;
  opacity: 0.7;
}

.close:hover {
  transform: rotate(90deg);
  opacity: 1;
}

.product-slider {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#modalSingleImage img {
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-details {
  padding: 0 0.5rem;
}

.product-description {
  max-height: 300px;
  overflow-y: auto;
  padding-right: 10px;
}

.product-description::-webkit-scrollbar {
  width: 6px;
}

.product-description::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.product-description::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 10px;
}

.product-description::-webkit-scrollbar-thumb:hover {
  background: #999;
}

/* Swiper slider styling */
.swiper-container {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.swiper-pagination-bullet {
  width: 10px;
  height: 10px;
  background: #fff;
  opacity: 0.7;
  border: 1px solid rgba(0, 0, 0, 0.2);
}

.swiper-pagination-bullet-active {
  opacity: 1;
  background: var(--primary, #0275d8);
}

.swiper-button-next, .swiper-button-prev {
  color: var(--primary, #0275d8);
  background: rgba(255, 255, 255, 0.7);
  width: 35px;
  height: 35px;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.swiper-button-next:hover, .swiper-button-prev:hover {
  background: rgba(255, 255, 255, 0.9);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.swiper-button-next:after, .swiper-button-prev:after {
  font-size: 16px;
  font-weight: bold;
}

.swiper-slide {
  padding: 5px 0;
}

.swiper-slide img {
  width: 100%;
  height: auto;
  max-height: 450px;
  object-fit: contain;
  transition: transform 0.3s ease;
}

/* Animation classes */
.appear-animation[data-appear-animation="fadeInUp"] {
  animation-name: fadeInUp;
  animation-duration: 0.75s;
  animation-fill-mode: both;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translate3d(0, 30px, 0);
  }
  to {
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .product-card .card:hover {
    transform: translateY(-5px);
  }
  
  .modal-dialog {
    max-width: 700px;
  }
}

@media (max-width: 768px) {
  .product-price {
    margin-top: 15px;
  }
  
  .modal-body .row {
    flex-direction: column;
  }
  
  .product-slider, #modalSingleImage {
    margin-bottom: 25px;
  }
}

@media (max-width: 576px) {
  #soko-products .container {
    padding-left: 20px;
    padding-right: 20px;
  }
  
  .btn-primary.btn-lg {
    font-size: 0.95rem;
    padding: 0.375rem 1rem;
  }
  
  .modal-content {
    border-radius: 10px;
  }
  
  .modal-footer {
    flex-direction: column;
  }
  
  .modal-footer .col-md-8,
  .modal-footer .col-md-4 {
    text-align: center !important;
  }
  
  .modal-footer .btn {
    margin-top: 10px;
  }
}
</style>

<script src="https://cdn.tailwindcss.com"></script>

<style>
        /* Dropdown animations */
        .dropdown-content {
            transition: all 0.2s ease-out;
        }
        
        .dropdown-content.hidden {
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
        }
        
        /* Mobile menu animations */
        .mobile-menu {
            transition: max-height 0.3s ease-out;
            max-height: 0;
            overflow: hidden;
        }
        
        .mobile-menu.active {
            max-height: 500px;
        }

        /* Overlay styles */
        .overlay {
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.2s ease-out;
            pointer-events: none;
        }
        
        .overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

		.group\/dropdown:hover .group-hover\/dropdown\:visible {
    visibility: visible;
    opacity: 1;
    transform: translateY(0);
		}

		.group\/dropdown:hover .group-hover\/dropdown\:rotate-180 {
			transform: rotate(180deg);
		}

		.dropdown-content {
			visibility: hidden;
			opacity: 0;
			transform: translateY(10px);
			transition: visibility 0.2s, opacity 0.2s, transform 0.2s;
		}

		/* Optional: Add backdrop when dropdown is open */
		.dropdown-backdrop {
			display: none;
			position: fixed;
			inset: 0;
			background-color: rgba(0, 0, 0, 0.1);
			z-index: 40;
		}

		.group\/dropdown:hover .dropdown-backdrop {
			display: block;
		}
</style>

        	<!-- Theme CSS -->
		<link rel="stylesheet" href=" {{ asset('storage/css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/css/theme-blog.css') }}">
		<link rel="stylesheet" href=" {{ asset('storage/css/theme-shop.css') }}">




        
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('storage/vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/vendor/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('storage/vendor/magnific-popup/magnific-popup.min.css') }}">
       
       	<link id="skinCSS" rel="stylesheet" href="{{ asset('storage/css/skins/default.css') }}">

        <link rel="stylesheet" href="{{ asset('storage/css/css/custom.css') }}">



		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

             <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">


        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
             <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

        @endif


		 {{-- <style>
    /* OPTIONAL: Make sure nothing else conflicts */
    body {
      margin: 2rem;
    }
  </style> --}}
    </head>
 <body class="font-sans antialiased"> 
    <!-- <body id="body" class="one-page alternative-font-5" data-plugin-scroll-spy data-plugin-options="{'target': '#header'}"> -->

    <!-- Header -->
    @include('components.header')
<!-- Add padding to the content below to prevent overlap -->
<div style="padding-top: 64px;">
    <!-- Your main content goes here -->
</div>
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

<!-- Add these scripts to your scripts section -->
<!-- Add these scripts to your scripts section -->
<script>
// Enhanced Product Modal & Slider Functionality with AJAX Product Details
document.addEventListener('DOMContentLoaded', function() {
  // Show products after loading
  setTimeout(() => {
    if (document.getElementById('products-loading')) {
      document.getElementById('products-loading').style.display = 'none';
    }
    if (document.getElementById('product-container')) {
      document.getElementById('product-container').style.display = 'flex';
    }
    initProductAnimations();
  }, 800);
  
  // DOM Elements
  const modal = document.getElementById('productModal');
  if (!modal) return; // Stop execution if modal doesn't exist
  
  const modalContent = document.getElementById('modal-content') || document.createElement('div');
  const modalLoading = document.getElementById('modal-loading') || document.createElement('div');
  const modalError = document.getElementById('modal-error') || document.createElement('div');
  const modalErrorMessage = document.getElementById('modal-error-message') || document.createElement('p');
  
  const modalProductName = document.getElementById('modalProductName') || document.createElement('h2');
  const modalPrice = document.getElementById('modalPrice') || document.createElement('p');
  const modalDiscountContainer = document.getElementById('modalDiscountContainer');
  const modalDiscountPrice = document.getElementById('modalDiscountPrice') || document.createElement('span');
  const modalDiscountBadge = document.getElementById('modalDiscountBadge') || document.createElement('span');
  const modalViewProductLink = document.getElementById('modalViewProductLink') || document.createElement('a');
  
  const modalThumbnail = document.getElementById('modalThumbnail') || document.createElement('img');
  const modalProductDescription = document.getElementById('modalProductDescription') || document.createElement('div');
  const modalSliderContainer = document.getElementById('modalSliderContainer');
  const modalSingleImage = document.getElementById('modalSingleImage');
  const modalSliderWrapper = document.getElementById('modalSliderWrapper');
  
  // Hard-coded mock product data to use as fallback
  const mockProducts = {
    // Map using the product IDs from your original data
    productMap: {},
    slugMap: {},

    // Initialize with sensible defaults based on product ID
    getProduct: function(productId) {
      // Check if we already have this product in our map
      if (this.productMap[productId]) {
        return this.productMap[productId];
      }

      // Create a new mock product based on ID
      const product = {
        id: productId,
        name: "Product " + productId,
        slug: "product-" + productId, // Generate a default slug
        description: "<p>This is a sample product description. The actual product details could not be loaded from the API.</p><p>Please visit the Soko 24 website for complete information about this product.</p>",
        main_price: "UGX --,---",
        has_discount: false,
        stroked_price: "",
        discount: "",
        thumbnail_image: "/img/placeholder-product.jpg",
        photos: [
          { path: "/img/placeholder-product.jpg" }
        ]
      };

      // Store in map for future reference
      this.productMap[productId] = product;
      this.slugMap[product.slug] = product;
      return product;
    },
    
    // Generate a slug from a product name
    generateSlug: function(name) {
      return name.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')  // Replace non-alphanumeric chars with hyphens
        .replace(/^-+|-+$/g, '')      // Remove leading/trailing hyphens
        .substring(0, 50);            // Limit length
    }
  };

  // Get from existing data on page
  document.querySelectorAll('.product-card').forEach(card => {
    try {
      const productId = card.getAttribute('data-product-id');
      const nameEl = card.querySelector('.card-title');
      const priceEl = card.querySelector('.card-text.font-weight-bold');
      const discountEl = card.querySelector('.badge-danger');
      const discountedPriceEl = card.querySelector('.text-decoration-line-through');
      const imgEl = card.querySelector('img');

      if (productId && nameEl) {
        const productName = nameEl.textContent.trim();
        const productSlug = mockProducts.generateSlug(productName);
        
        const mockProduct = {
          id: productId,
          name: productName,
          slug: productSlug,
          description: "<p>This product is from the Soko 24 collection. Please visit the Soko website for full details.</p>",
          main_price: priceEl ? priceEl.textContent.trim() : "UGX --,---",
          has_discount: !!discountEl,
          stroked_price: discountedPriceEl ? discountedPriceEl.textContent.trim() : "",
          discount: discountEl ? discountEl.textContent.trim() : "",
          thumbnail_image: imgEl ? imgEl.src : "/img/placeholder-product.jpg",
          photos: [
            { path: imgEl ? imgEl.src : "/img/placeholder-product.jpg" }
          ]
        };
        
        // Store this product in our mock database
        mockProducts.productMap[productId] = mockProduct;
        mockProducts.slugMap[productSlug] = mockProduct;
      }
    } catch (e) {
      console.warn('Error extracting product data from card:', e);
    }
  });
  
  // Function to show different modal states (loading, content, error)
  function showModalState(state) {
    if (modalLoading) {
      modalLoading.style.display = state === 'loading' ? 'block' : 'none';
    }
    if (modalContent) {
      modalContent.style.display = state === 'content' ? 'block' : 'none';
    }
    if (modalError) {
      modalError.style.display = state === 'error' ? 'block' : 'none';
    }
  }
  
  // Function to fetch product data via AJAX
  async function fetchProductData(productId) {
    try {
      // Call your controller endpoint
      const response = await fetch(`/api/product/${productId}`);
      
      if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
      }
      
      const data = await response.json();
      
      if (data.success && data.data && data.data.length > 0) {
        return data.data[0];
      } else {
        throw new Error("No product details found.");
      }
    } catch (error) {
      console.error('Error fetching product:', error);
      throw error;
    }
  }
  
  // Simplified modal display function for compatibility with original code
  function openSimpleModal(product) {
    // Clear existing content
    if (modalProductName) modalProductName.textContent = product.name;
    if (modalProductDescription) modalProductDescription.innerHTML = product.description || '';
    
    // Display the image
    if (modalThumbnail) {
      modalThumbnail.style.display = 'block';
      modalThumbnail.src = product.thumbnail_image;
      modalThumbnail.alt = product.name;
      
      // Handle image loading errors
      modalThumbnail.onerror = function() {
        this.src = '/img/placeholder-product.jpg';
        this.alt = 'Product image unavailable';
      };
    }
    
    // Update pricing information
    if (modalPrice) modalPrice.textContent = product.main_price;
    
    // Update the link to Soko
    if (modalViewProductLink) {
      modalViewProductLink.href = `https://soko.sanaa.co/product/${product.slug}`;
    }
    
    // Handle discount information
    if (modalDiscountContainer && modalDiscountPrice && modalDiscountBadge) {
      if (product.has_discount) {
        modalDiscountPrice.textContent = product.stroked_price;
        modalDiscountBadge.textContent = product.discount;
        modalDiscountContainer.classList.remove('d-none');
      } else {
        modalDiscountContainer.classList.add('d-none');
      }
    }
    
    // Show the modal
    modal.style.display = 'flex';
    modal.classList.add('show');
    
    // Make sure the modal is styled correctly
    const modalContentElem = modal.querySelector('.modal-content');
    if (modalContentElem) {
      modalContentElem.style.display = 'block';
    }
    
    // Try Bootstrap modal if available
    if (typeof $ !== 'undefined') {
      try {
        $(modal).modal('show');
      } catch (e) {
        console.warn('Bootstrap modal failed, using direct style manipulation');
      }
    }
  }
  
  // Open product modal with AJAX
  async function openProductModal(productId) {
    try {
      // Show loading state
      if (typeof showModalState === 'function') {
        showModalState('loading');
      }
      
      // Show the modal
      modal.style.display = 'flex';
      modal.classList.add('show');
      
      let product;
      
      // Try to fetch product data via AJAX
      try {
        product = await fetchProductData(productId);
      } catch (error) {
        console.warn('API fetch failed, using fallback data:', error);
        // Use fallback data if the API call fails
        product = mockProducts.getProduct(productId);
      }
      
      // Display the product in the modal
      openSimpleModal(product);
      
      // Show content state
      if (typeof showModalState === 'function') {
        showModalState('content');
      }
      
    } catch (error) {
      console.error('Error opening product modal:', error);
      // Show error message
      if (modalErrorMessage) {
        modalErrorMessage.textContent = 'Failed to load product details. Please try again later.';
      }
      // Show error state
      if (typeof showModalState === 'function') {
        showModalState('error');
      } else {
        // Fallback error display
        if (modalError) modalError.style.display = 'block';
      }
    }
  }
  
  // Close modal event handlers
  function closeProductModal() {
    // Try Bootstrap method first
    if (typeof $ !== 'undefined') {
      try {
        $(modal).modal('hide');
      } catch (e) {
        console.warn('Bootstrap modal hide failed, using direct style manipulation');
      }
    }
    
    // Direct style manipulation as fallback
    modal.style.display = 'none';
    modal.classList.remove('show');
    
    // Stop swiper if it exists
    if (window.modalSwiper && window.modalSwiper.autoplay) {
      window.modalSwiper.autoplay.stop();
    }
  }
  
  // Setup close modal buttons
  document.querySelectorAll('.close-modal').forEach(btn => {
    btn.addEventListener('click', closeProductModal);
  });
  
  // Add click event to product cards
  document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', function(e) {
      // Prevent default only if the click is not on a link
      if (e.target.tagName.toLowerCase() !== 'a' && !e.target.closest('a')) {
        e.preventDefault();
      }
      
      const productId = this.getAttribute('data-product-id');
      if (productId) {
        openProductModal(productId);
      }
    });
    
    // Add keyboard accessibility
    card.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        const productId = this.getAttribute('data-product-id');
        if (productId) {
          openProductModal(productId);
        }
      }
    });
  });
  
  // Init animations for product cards
  function initProductAnimations() {
    const animateProducts = () => {
      const cards = document.querySelectorAll('.product-card');
      cards.forEach((card, index) => {
        setTimeout(() => {
          card.classList.add('appear-animation');
          card.dataset.appearAnimation = 'fadeInUp';
          card.dataset.appearAnimationDelay = (index * 100) + 200;
        }, 100);
      });
    };
  
    // Initialize animations when product section is visible
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateProducts();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
    
      const productSection = document.getElementById('soko-products');
      if (productSection) {
        observer.observe(productSection);
      }
    } else {
      // Fallback for browsers without IntersectionObserver support
      animateProducts();
    }
  }
  
  // Lazy load product images
  document.querySelectorAll('.product-card img').forEach(img => {
    img.loading = 'lazy';
    
    // Add placeholder for images that fail to load
    img.onerror = function() {
      this.src = '/img/placeholder-product.jpg';
      this.alt = 'Product image unavailable';
    };
  });
  
  // Handle close on escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && 
        (modal.style.display === 'flex' || 
         modal.classList.contains('show') || 
         (typeof $ !== 'undefined' && $(modal).is(':visible')))) {
      closeProductModal();
    }
  });
  
  // Handle click outside modal
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      closeProductModal();
    }
  });
});
</script>
	
    <script>
        // Dropdown functionality
        document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const content = dropdown.querySelector('.dropdown-content');
            const overlay = document.querySelector('.overlay');

            button.addEventListener('click', (e) => {
                e.stopPropagation();
                content.classList.toggle('hidden');
                overlay.classList.toggle('active');
                button.setAttribute('aria-expanded', content.classList.contains('hidden') ? 'false' : 'true');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                content.classList.add('hidden');
                overlay.classList.remove('active');
                button.setAttribute('aria-expanded', 'false');
            });
        });

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });
    </script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>



    <!-- Vendor -->
						<script src="{{ asset('storage/vendor/jquery/jquery.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/jquery.cookie/jquery.cookie.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/jquery.validation/jquery.validate.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/lazysizes/lazysizes.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/isotope/jquery.isotope.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/vide/jquery.vide.min.js') }}"></script>
						<script src="{{ asset('storage/vendor/vivus/vivus.min.js') }}"></script>

						<!-- Theme Base, Components and Settings -->
						<script src="{{ asset('storage/js/theme.js') }}"></script>

						<script src="{{ asset('storage/js/views/view.contact.js') }}"></script>

						<!-- Theme Custom -->
						<script src="{{ asset('storage/js/custom.js') }}"></script>

						<!-- Theme Initialization Files -->
						<script src="{{ asset('storage/js/theme.init.js') }}"></script>

					<!-- Examples -->
						<script src="{{ asset('storage/js/examples/examples.portfolio.js') }}"></script>


    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
