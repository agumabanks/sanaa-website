<x-pages-layout title="Contact Us | {{ config('app.name') }}">
    <x-slot name="metaDescription">
        Get in touch with Sanaa Co. for questions, support, or business inquiries. We're here to help you succeed with our innovative digital solutions.
    </x-slot>

    @push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slide-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }

        .animate-slide-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981, #34d399, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .contact-card {
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .contact-info-item {
            position: relative;
            overflow: hidden;
        }

        .contact-info-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
            transition: left 0.8s ease;
        }

        .contact-info-item:hover::before {
            left: 100%;
        }

        .pulse-ring {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }
    </style>
    @endpush

    <!-- Enhanced Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 text-white overflow-hidden">
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
            <div class="max-w-4xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-emerald-500/20 border border-emerald-400/30 rounded-full text-emerald-300 text-sm font-medium mb-8 animate-fade-up">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    Let's Connect
                </div>

                <!-- Main title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-8 leading-tight animate-fade-up" style="animation-delay: 0.2s;">
                    <span class="gradient-text">Get in Touch</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed animate-fade-up" style="animation-delay: 0.4s;">
                    Questions, feedback, or ready to start your next project? We're here to help you succeed with personalized support and expert guidance.
                </p>

                <!-- Quick stats -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8 max-w-2xl mx-auto animate-fade-up" style="animation-delay: 0.6s;">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-emerald-400 mb-2">< 2h</div>
                        <div class="text-gray-400 text-sm">Response Time</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-emerald-400 mb-2">24/7</div>
                        <div class="text-gray-400 text-sm">Support Available</div>
                    </div>
                    <div class="text-center col-span-2 md:col-span-1">
                        <div class="text-2xl font-bold text-emerald-400 mb-2">100%</div>
                        <div class="text-gray-400 text-sm">Free Consultation</div>
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

    <!-- Main Content Section -->
    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if(session('status'))
                <div class="mb-12 max-w-2xl mx-auto">
                    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-emerald-800 animate-fade-up">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-emerald-900">Message Sent Successfully!</h3>
                                <p class="text-emerald-700">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-16 items-start">
                
                <!-- Contact Information -->
                <div class="space-y-8 animate-slide-left">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Let's Start a <span class="gradient-text">Conversation</span>
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed mb-8">
                            Ready to transform your business? Reach out to us anytime and we'll get back to you promptly. We're committed to providing exceptional support every step of the way.
                        </p>
                    </div>

                    <!-- Contact Methods Grid -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="contact-info-item contact-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Email Us</h3>
                                    <p class="text-sm text-gray-500">For general inquiries</p>
                                </div>
                            </div>
                            <a href="mailto:info@sanaa.co" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                                info@sanaa.co
                            </a>
                        </div>

                        <!-- Phone -->
                        <div class="contact-info-item contact-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Call Us</h3>
                                    <p class="text-sm text-gray-500">Customer Support</p>
                                </div>
                            </div>
                            <a href="tel:0706272481" class="text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                0706 27-2481
                            </a>
                        </div>

                        <!-- Sales -->
                        <div class="contact-info-item contact-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Sales Team</h3>
                                    <p class="text-sm text-gray-500">Business inquiries</p>
                                </div>
                            </div>
                            <a href="tel:0200903222" class="text-purple-600 hover:text-purple-700 font-medium transition-colors">
                                0200 90-3222
                            </a>
                        </div>

                        <!-- WhatsApp -->
                        <div class="contact-info-item contact-card bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">WhatsApp</h3>
                                    <p class="text-sm text-gray-500">Quick chat support</p>
                                </div>
                            </div>
                            <a href="https://wa.me/256706272481" target="_blank" class="text-green-600 hover:text-green-700 font-medium transition-colors">
                                Chat with us
                            </a>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="contact-card bg-gradient-to-r from-emerald-50 to-blue-50 rounded-2xl p-8 border border-emerald-100">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Our Location</h3>
                                <p class="text-gray-600">Kampala, Uganda</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            We're based in the heart of East Africa's tech hub, serving clients globally with cutting-edge digital solutions.
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="animate-slide-right">
                    <div class="glass-card rounded-3xl p-8 shadow-2xl">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Send us a Message</h3>
                            <p class="text-gray-600">Fill out the form below and we'll get back to you within 24 hours.</p>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid sm:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Full Name *
                                    </label>
                                    <input 
                                        id="name" 
                                        name="name" 
                                        type="text" 
                                        required 
                                        value="{{ old('name') }}"
                                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" 
                                        placeholder="Your full name"
                                    />
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email Address *
                                    </label>
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        required 
                                        value="{{ old('email') }}"
                                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" 
                                        placeholder="your@email.com"
                                    />
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Subject -->
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Subject
                                </label>
                                <input 
                                    id="subject" 
                                    name="subject" 
                                    type="text" 
                                    value="{{ old('subject') }}"
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" 
                                    placeholder="What's this about?"
                                />
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Message *
                                </label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="6" 
                                    required
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 resize-none" 
                                    placeholder="Tell us about your project or how we can help..."
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button 
                                    type="submit" 
                                    class="w-full pulse-ring inline-flex items-center justify-center px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                >
                                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Send Message
                                </button>
                            </div>

                            <!-- Form Footer -->
                            <div class="text-center text-sm text-gray-500 pt-4">
                                We typically respond within 2 hours during business hours.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Messages Section (Admin Only) -->
    @auth
        @if(isset($items) && $items->count())
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            Recent Messages
                        </h2>
                        
                        <div class="space-y-6">
                            @foreach($items as $msg)
                                <div class="border border-gray-200 rounded-2xl p-6 hover:border-emerald-200 transition-colors">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $msg->name }}</h3>
                                            <p class="text-emerald-600 text-sm">{{ $msg->email }}</p>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                            {{ $msg->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    @if(isset($msg->subject) && $msg->subject)
                                        <p class="font-medium text-gray-800 mb-2">{{ $msg->subject }}</p>
                                    @endif
                                    <p class="text-gray-600 leading-relaxed">{{ $msg->message }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endauth

    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Frequently Asked <span class="gradient-text">Questions</span>
                </h2>
                <p class="text-xl text-gray-600">
                    Quick answers to common questions about our services and process.
                </p>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-50 rounded-2xl p-6 hover:bg-gray-100 transition-colors">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">How quickly do you respond to inquiries?</h3>
                    <p class="text-gray-600">We typically respond within 2 hours during business hours (9 AM - 6 PM EAT) and within 24 hours on weekends.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 hover:bg-gray-100 transition-colors">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Do you offer free consultations?</h3>
                    <p class="text-gray-600">Yes! We provide free initial consultations to understand your needs and discuss how we can help achieve your goals.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 hover:bg-gray-100 transition-colors">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">What's the best way to reach you for urgent matters?</h3>
                    <p class="text-gray-600">For urgent issues, WhatsApp is your best bet as we monitor it closely throughout the day. You can also call our support line directly.</p>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation and enhancement
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, textarea');
            
            // Add real-time validation
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                        this.classList.remove('border-gray-300', 'focus:border-emerald-500', 'focus:ring-emerald-500');
                    } else {
                        this.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                        this.classList.add('border-gray-300', 'focus:border-emerald-500', 'focus:ring-emerald-500');
                    }
                });
            });

            // Form submission handling
            form.addEventListener('submit', function(e) {
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                // Show loading state
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sending...
                `;
                submitButton.disabled = true;
                
                // Reset button after 3 seconds if form doesn't submit successfully
                setTimeout(() => {
                    if (submitButton.disabled) {
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                    }
                }, 3000);
            });

            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0) translateX(0)';
                    }
                });
            }, observerOptions);

            // Observe animated elements
            document.querySelectorAll('.animate-slide-left, .animate-slide-right, .contact-card').forEach((el, index) => {
                el.style.opacity = '0';
                if (el.classList.contains('animate-slide-left')) {
                    el.style.transform = 'translateX(-30px)';
                } else if (el.classList.contains('animate-slide-right')) {
                    el.style.transform = 'translateX(30px)';
                } else {
                    el.style.transform = 'translateY(20px)';
                }
                el.style.transition = 'all 0.6s ease';
                el.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(el);
            });

            // Add floating animation to contact cards
            document.querySelectorAll('.contact-card').forEach((card, index) => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Smooth scrolling for any anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    @endpush
</x-pages-layout>
