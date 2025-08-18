<header class="bg-white border-b border-gray-200 shadow-sm  border-b border-gray-200 fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <!-- Logo Section -->
      <div class="flex items-center">
        <a href="{{ route('home') }}" class="flex items-center">
          <img class="h-8 w-auto" src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="Sanaa Logo">
        </a>
      </div>

      <!-- Navigation Links -->
      <nav class="hidden sm:flex sm:space-x-8 items-center relative">
        <!-- Simple Links -->
        <a 
          href="{{ route('about') }}" 
          class="text-gray-800 hover:text-green-600 font-medium text-sm transition-colors duration-200"
        >
          Personal
        </a>
        
        <!-- Company Dropdown -->
        <div 
          class="relative group/dropdown" 
          x-data="{ open: false, timeoutId: null }" 
          @mouseenter="clearTimeout(timeoutId); open = true" 
          @mouseleave="timeoutId = setTimeout(() => open = false, 200)"
          @keydown.escape="open = false"
        >
          <!-- Parent Link + Down Arrow Icon -->
          <button 
            @click="open = !open"
            aria-expanded="false"
            x-bind:aria-expanded="open.toString()"
            aria-controls="dropdown-menu"
            class="text-gray-800 hover:text-green-600 font-medium text-sm inline-flex items-center space-x-2 py-2 transition-colors duration-200"
          >
            <span>Company</span>
            <svg 
              class="w-4 h-4 transition-transform duration-200"
              x-bind:class="{ 'rotate-180': open }"
              xmlns="http://www.w3.org/2000/svg" 
              viewBox="0 0 20 20" 
              fill="currentColor"
            >
              <path 
                fill-rule="evenodd" 
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 
                   01-1.414 0l-4-4a1 1 0 010-1.414z" 
                clip-rule="evenodd" 
              />
            </svg>
          </button>

          <!-- Dropdown Menu (Full Screen) -->
          <div 
            id="dropdown-menu"
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="fixed inset-20 bg-white border border-gray-200 shadow-lg z-50 transform  border border-gray-200 shadow-lg z-50 rounded-lg " 
            {{-- absolute left-1/2 transform -translate-x-1/2 mt-2 w-64 bg-white  border border-gray-200 shadow-lg z-50 rounded-lg --}}
            x-cloak
          >
            <!-- Optional: Close Button in Full-Screen Overlay -->
            <button 
              @click="open = false"
              class="absolute top-4 right-4 p-2 text-gray-500 hover:text-green-600 
                     focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200"
              aria-label="Close"
            >
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path 
                  stroke-linecap="round" 
                  stroke-linejoin="round" 
                  stroke-width="2" 
                  d="M6 18L18 6M6 6l12 12" 
                />
              </svg>
            </button>

            <!-- Overlay Content Container -->
            <div class="p-6 max-w-screen-lg mx-auto">
              <!-- Heading -->
              <h2 class="text-2xl font-bold mb-4 text-gray-900 flex items-center">
                Discover Our Company
                <svg class="w-4 h-4 ml-2 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M14 5l7 7m0 0l-7 7m7-7H3" 
                  />
                </svg>
              </h2>

              <!-- 3-Column Grid -->
              <div class="grid grid-cols-3 gap-8 text-sm text-gray-700">
                <!-- Column 1: General -->
                <div class="space-y-4">
                  <h3 class="font-bold text-gray-900">General</h3>
                  <ul class="space-y-2">
                    <li>
                      <a 
                        href="{{ route('company') }}" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        About Us
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        News &amp; Media
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Company Reviews
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Blog
                      </a>
                    </li>
                  </ul>
                </div>

                <!-- Column 2: Careers -->
                <div class="space-y-4">
                  <h3 class="font-bold text-gray-900">Careers</h3>
                  <ul class="space-y-2">
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Careers
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Working at Sanaa
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Culture
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Talent Programs
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Diversity &amp; Inclusion
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Relocation
                      </a>
                    </li>
                  </ul>
                </div>

                <!-- Column 3: Investor Relations -->
                <div class="space-y-4">
                  <h3 class="font-bold text-gray-900">Investor Relations</h3>
                  <ul class="space-y-2">
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Annual Report
                      </a>
                    </li>
                    <li>
                      <a 
                        href="#" 
                        class="hover:text-green-600 transition-colors duration-200 block"
                      >
                        Shareholder Relations
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- End 3-Column Grid -->
            </div>
          </div>
        </div>
        
        <!-- More Simple Links -->
        <a
          href="{{ route('products') }}"
          class="font-medium text-sm transition-colors duration-200 {{ request()->routeIs('products') ? 'text-green-600' : 'text-gray-800 hover:text-green-600' }}"
        >
          Products
        </a>
        <a
          href="{{ route('services') }}"
          class="font-medium text-sm transition-colors duration-200 {{ request()->routeIs('services') ? 'text-green-600' : 'text-gray-800 hover:text-green-600' }}"
        >
          Services
        </a>
        <a
          href="{{ route('bulk-sms') }}"
          class="font-medium text-sm transition-colors duration-200 {{ request()->routeIs('bulk-sms') ? 'text-green-600' : 'text-gray-800 hover:text-green-600' }}"
        >
          Bulk SMS
        </a>
        <a
          href="{{ route('prices') }}"
          class="text-gray-800 hover:text-green-600 font-medium text-sm transition-colors duration-200"
        >
          Sanaa &lt;18
        </a>
      </nav>

      <!-- Shop and Cart Section -->
      <div class="hidden sm:flex items-center space-x-4">
        <a 
          href="http://soko.sanaa.co/" 
          class="text-gray-800 hover:text-green-600 font-medium text-sm transition-colors duration-200"
        >
          Shop 24
        </a>
        <a 
          href="{{ route('support') }}" 
          class="text-gray-800 hover:text-green-600 font-medium text-sm transition-colors duration-200"
        >
          Support
        </a>
        @auth
        <a
          href="{{ route('dashboard') }}"
          class="text-gray-800 hover:text-green-600 font-medium text-sm transition-colors duration-200"
        >
          Dashboard
        </a>
        @else
        <a
          href="{{ route('login') }}"
          class="text-gray-800 hover:text-green-600 font-medium text-sm transition-colors duration-200"
        >
          Login
        </a>
        @endauth

        <button id="theme-toggle" class="p-2 rounded text-gray-800 hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition" aria-label="Toggle dark mode">
          <svg class="h-5 w-5 block dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-9h-1M4.34 12h-1m15.02 5.66l-.7-.7M6.34 6.34l-.7-.7m12.02 0l-.7.7M6.34 17.66l-.7.7M12 5a7 7 0 100 14 7 7 0 000-14z" />
          </svg>
          <svg class="h-5 w-5 hidden dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
          </svg>
        </button>
      </div>

      <!-- Mobile Menu Button -->
      <div class="sm:hidden">
        <button 
          type="button" 
          class="p-2 text-gray-500 hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200" 
          aria-label="Toggle mobile menu"
        >
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" 
               fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M4 6h16M4 12h16M4 18h16" 
            />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Navigation Menu -->
  <div class="sm:hidden hidden">
    <nav class="space-y-1 px-4 pb-4">
      <!-- Mobile menu items go here -->
    </nav>
  </div>
  
</header>
