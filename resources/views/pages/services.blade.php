<x-pages-layout title="Services | {{ config('app.name') }}">
    <x-slot name="metaDescription">
        Explore our comprehensive range of services at Sanaa Co., including content generation, web development, consulting, and more. Discover how we empower businesses with innovative digital solutions.
    </x-slot>

    @push('styles')
    <style>
        /* Custom animations and enhanced styles */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out forwards;
        }

        .animate-fade-scale {
            animation: fadeInScale 0.8s ease-out forwards;
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        .service-card {
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
            transition: left 0.8s ease;
        }

        .service-card:hover::before {
            left: 100%;
        }

        .feature-icon {
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, #10b981, #34d399);
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981, #34d399, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .service-grid-enter {
            opacity: 0;
            transform: translateY(20px);
        }

        .service-grid-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.6s ease;
        }

        /* Responsive enhancements */
        @media (max-width: 640px) {
            .hero-title {
                font-size: 2.5rem !important;
            }
        }
    </style>
    @endpush

    <!-- Enhanced Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 text-white overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-float" style="animation-delay: -1.5s;"></div>
        </div>

        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/30"></div>

        <!-- Hero content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <div class="max-w-5xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-emerald-500/20 border border-emerald-400/30 rounded-full text-emerald-300 text-sm font-medium mb-8 animate-fade-scale">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Professional Services
                </div>

                <!-- Main title -->
                <h1 class="hero-title text-5xl md:text-6xl lg:text-7xl font-bold mb-8 leading-tight animate-slide-up">
                    Transform Your Business with Our 
                    <span class="gradient-text">Premium Services</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.2s;">
                    From digital transformation to innovative solutions, we provide comprehensive services tailored to elevate your business with cutting-edge technology and expert guidance.
                </p>

                <!-- CTA buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16 animate-slide-up" style="animation-delay: 0.4s;">
                    <a href="{{ route('contact') }}" class="group inline-flex items-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/25">
                        <svg class="mr-2 w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Get Started Today
                    </a>
                    <a href="#services" class="group inline-flex items-center px-8 py-4 glass-effect text-white font-semibold rounded-full hover:bg-white/20 transition-all duration-300">
                        <svg class="mr-2 w-5 h-5 group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        Explore Services
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-3xl mx-auto animate-slide-up" style="animation-delay: 0.6s;">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-400 mb-2">500+</div>
                        <div class="text-gray-400 text-sm">Projects Delivered</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-400 mb-2">98%</div>
                        <div class="text-gray-400 text-sm">Client Satisfaction</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-400 mb-2">24/7</div>
                        <div class="text-gray-400 text-sm">Support Available</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-400 mb-2">5+</div>
                        <div class="text-gray-400 text-sm">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section id="services" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($services->isEmpty())
                <!-- Enhanced Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-lg mx-auto">
                        <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100">
                            <div class="w-24 h-24 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center mx-auto mb-8">
                                <svg class="w-12 h-12 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-4">Services Coming Soon</h3>
                            <p class="text-gray-600 mb-8 leading-relaxed text-lg">
                                We're crafting an exceptional lineup of services designed to help your business thrive in the digital age. Our team is working diligently to bring you innovative solutions.
                            </p>
                            <div class="space-y-4">
                                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    Get Early Access
                                </a>
                                <p class="text-sm text-gray-500">Be the first to know when we launch</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Services Header -->
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-800 rounded-full text-sm font-medium mb-6">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                        Our Services Portfolio
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        What We <span class="gradient-text">Offer</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        From digital transformation to innovative solutions, we provide comprehensive services tailored to your business needs and designed to drive sustainable growth.
                    </p>
                </div>

                <!-- Enhanced Services Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="services-grid">
                    @foreach($services as $index => $service)
                        <div class="service-card group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-700 overflow-hidden transform hover:-translate-y-3 border border-gray-100 hover:border-emerald-200" 
                             style="animation-delay: {{ $index * 0.1 }}s;">
                            
                            <!-- Service Header -->
                            <div class="p-8 pb-6">
                                <!-- Icon -->
                                <div class="relative mb-6">
                                    @if($service->icon)
                                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl group-hover:from-emerald-100 group-hover:to-emerald-200 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                                            <i class="text-emerald-600 text-2xl group-hover:scale-110 transition-transform duration-300">{{ $service->icon }}</i>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl group-hover:from-emerald-100 group-hover:to-emerald-200 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                                            <svg class="w-8 h-8 text-emerald-600 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Popular badge for first service -->
                                    @if($index === 0)
                                        <div class="absolute -top-2 -right-2 bg-gradient-to-r from-orange-400 to-pink-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                            Popular
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Service title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-300">
                                    {{ $service->name }}
                                </h3>
                                
                                <!-- Service description -->
                                <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">
                                    {{ $service->description }}
                                </p>

                                <!-- Features list (if available) -->
                                @if(isset($service->features) && $service->features)
                                    <ul class="space-y-2 mb-6">
                                        @foreach(explode(',', $service->features) as $feature)
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 text-emerald-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ trim($feature) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Service Footer -->
                            <div class="px-8 pb-8">
                                <div class="border-t border-gray-100 pt-6">
                                    <div class="flex items-center justify-between">
                                        <!-- Pricing -->
                                        <div>
                                            @if($service->price)
                                                <div class="text-3xl font-bold text-emerald-600">
                                                    ${{ number_format($service->price, 0) }}
                                                </div>
                                                <div class="text-sm text-gray-500">Starting from</div>
                                            @else
                                                <div class="text-lg font-semibold text-gray-700">
                                                    Custom Pricing
                                                </div>
                                                <div class="text-sm text-gray-500">Contact for quote</div>
                                            @endif
                                        </div>
                                        
                                        <!-- CTA Button -->
                                        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-emerald-600 bg-emerald-50 rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300 group-hover:bg-emerald-600 group-hover:text-white group-hover:shadow-lg">
                                            <span class="mr-2">Learn More</span>
                                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Hover gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/5 to-emerald-800/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Services Button -->
                <div class="text-center mt-16">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Discuss Custom Solutions
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Enhanced Features Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 via-blue-500 to-purple-600"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Why Choose <span class="gradient-text">Our Services</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    We combine cutting-edge expertise, innovative thinking, and unwavering dedication to deliver exceptional results that drive your business forward.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card text-center p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 group">
                    <div class="feature-icon w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors">Lightning Fast</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Rapid deployment and quick turnaround times without compromising on quality or attention to detail.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card text-center p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 group">
                    <div class="feature-icon w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">Proven Expertise</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Years of experience and a stellar track record of successful projects across diverse industries.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card text-center p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 group">
                    <div class="feature-icon w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 11-.75 19.37"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-purple-600 transition-colors">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Round-the-clock support and monitoring to ensure your business operations run smoothly.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card text-center p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 group">
                    <div class="feature-icon w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors">Scalable Solutions</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Solutions that grow with your business, from startup to enterprise scale operations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced CTA Section -->
    <section class="py-24 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-800 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-400/20 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center px-4 py-2 bg-emerald-500/30 border border-emerald-400/30 rounded-full text-emerald-100 text-sm font-medium mb-8">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Ready to Get Started?
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">
                Transform Your Business <br class="hidden sm:block">
                <span class="text-emerald-200">Starting Today</span>
            </h2>
            
            <p class="text-xl md:text-2xl text-emerald-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                Join hundreds of businesses that have already transformed their operations with our innovative services. Let's discuss how we can help you achieve your goals.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-12">
                <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center px-10 py-5 bg-white text-emerald-600 font-bold rounded-full hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-lg">
                    <svg class="mr-3 w-6 h-6 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Start Your Project
                </a>
                
                <a href="{{ route('products') }}" class="group inline-flex items-center justify-center px-10 py-5 border-2 border-white/30 text-white font-bold rounded-full hover:bg-white/10 hover:border-white transition-all duration-300 text-lg">
                    <svg class="mr-3 w-6 h-6 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    View Products
                </a>
            </div>

            <!-- Trust indicators -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 text-emerald-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Free Consultation</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>No Setup Fees</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>30-Day Guarantee</span>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const headerOffset = 80;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Enhanced service cards animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('animate-slide-up');
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, observerOptions);

            // Observe service cards
            document.querySelectorAll('.service-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(card);
            });

            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
                setTimeout(() => {
                    observer.observe(card);
                }, index * 50);
            });

            // Add loading state simulation for demonstration
            const servicesGrid = document.getElementById('services-grid');
            if (servicesGrid && servicesGrid.children.length === 0) {
                // Show skeleton loading
                for (let i = 0; i < 6; i++) {
                    const skeleton = document.createElement('div');
                    skeleton.className = 'bg-white rounded-3xl shadow-lg p-8 animate-pulse';
                    skeleton.innerHTML = `
                        <div class="w-16 h-16 bg-gray-200 rounded-2xl mb-6"></div>
                        <div class="h-6 bg-gray-200 rounded-lg mb-4"></div>
                        <div class="h-4 bg-gray-200 rounded mb-2"></div>
                        <div class="h-4 bg-gray-200 rounded mb-2"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4 mb-6"></div>
                        <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                            <div class="h-8 bg-gray-200 rounded w-20"></div>
                            <div class="h-10 bg-gray-200 rounded-full w-24"></div>
                        </div>
                    `;
                    servicesGrid.appendChild(skeleton);
                }
            }

            // Parallax effect for background elements
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.animate-float');
                
                parallaxElements.forEach((element, index) => {
                    const speed = 0.1 + (index * 0.05);
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });

            // Add subtle animation to stats counters
            const statsCounters = document.querySelectorAll('.text-3xl');
            statsCounters.forEach(counter => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const text = entry.target.textContent;
                            if (text.includes('+') || text.includes('%')) {
                                entry.target.style.transform = 'scale(1.1)';
                                entry.target.style.transition = 'transform 0.3s ease';
                                setTimeout(() => {
                                    entry.target.style.transform = 'scale(1)';
                                }, 300);
                            }
                        }
                    });
                });
                observer.observe(counter);
            });
        });
    </script>
    @endpush
</x-pages-layout>