@section('title', 'Register | ' . config('app.name'))
<x-auth-layout>
    <style>
        /* MacBook-inspired enhancements for Register */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --surface-glass: rgba(255, 255, 255, 0.02);
            --surface-elevated: rgba(28, 28, 30, 0.95);
            --border-elevated: rgba(255, 255, 255, 0.12);
            --text-premium: rgba(255, 255, 255, 0.98);
            --text-secondary: rgba(255, 255, 255, 0.68);
            --accent-glow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            --accent-glow-focus: 0 0 0 3px rgba(34, 197, 94, 0.15);
            --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* Override guest layout background */
        body {
            background: #000000 !important;
            color: var(--text-premium) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Premium background setup */
        .min-h-screen {
            background: #000000 !important;
            position: relative;
        }

        .min-h-screen::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2067&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            filter: saturate(1.1) contrast(1.05);
            z-index: -3;
        }

        .min-h-screen::after {
            content: '';
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(1200px 600px at 50% 0%, rgba(0,0,0,0) 20%, rgba(0,0,0,0.55) 70%, rgba(0,0,0,0.8) 100%),
                rgba(0, 0, 0, 0.55);
            z-index: -2;
        }

        /* Soft ambient light */
        .min-h-screen .flex.items-center.justify-center::before {
            content: '';
            position: absolute;
            top: -10rem;
            left: 50%;
            transform: translateX(-50%);
            width: 900px;
            height: 900px;
            border-radius: 50%;
            background: conic-gradient(from 180deg at 50% 50%, #00ffa3, #00e5ff, #b3ff00, #00ffa3);
            filter: blur(120px);
            opacity: 0.25;
            z-index: -1;
        }

        /* Enhanced authentication card */
        .authentication-card-container {
            position: relative;
            width: 100%;
            max-width: 480px;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(32px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Glass morphism card */
        .bg-white {
            background: rgba(0, 0, 0, 0.25) !important;
            backdrop-filter: blur(24px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(180%) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 1.5rem !important;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                0 0 32px rgba(34, 197, 94, 0.03),
                inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: visible !important;
        }

        .bg-white::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.5rem;
            padding: 1px;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.2) 0%, 
                rgba(255, 255, 255, 0.1) 25%,
                rgba(255, 255, 255, 0.05) 50%, 
                rgba(255, 255, 255, 0.02) 75%,
                rgba(255, 255, 255, 0.05) 100%);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: subtract;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            pointer-events: none;
        }

        .bg-white::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255, 255, 255, 0.3) 20%, 
                rgba(255, 255, 255, 0.1) 80%, 
                transparent 100%);
        }

        /* Card hover effect */
        .bg-white:hover {
            transform: perspective(1000px) rotateX(0.5deg) rotateY(0.5deg) translateY(-2px);
            box-shadow: 
                0 40px 80px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        /* Logo styling */
        .authentication-card-logo {
            margin-bottom: 2rem !important;
            text-align: center;
            position: relative;
        }

        .authentication-card-logo a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.025em;
            color: var(--text-premium) !important;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            padding: 0.75rem;
            border-radius: 0.75rem;
        }

        .authentication-card-logo a::after {
            content: '•';
            color: rgb(34, 197, 94);
            margin-left: 0.25rem;
            margin-top: -0.5rem;
            font-size: 0.75rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .authentication-card-logo a:hover {
            transform: translateY(-1px);
        }

        /* Title styling */
        h1 {
            color: var(--text-premium) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
            font-size: 1.875rem !important;
            font-weight: 600 !important;
            letter-spacing: -0.025em !important;
            margin-bottom: 0.5rem !important;
            text-align: center !important;
        }

        /* Form styling */
        .space-y-6 > * + * {
            margin-top: 1.5rem !important;
        }

        /* Label styling */
        label {
            display: block !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            letter-spacing: -0.025em !important;
            color: rgba(255, 255, 255, 0.7) !important;
            margin-bottom: 0.5rem !important;
        }

        /* Input styling */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100% !important;
            height: 3rem !important;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 0.75rem !important;
            padding: 0 1rem !important;
            font-size: 0.9375rem !important;
            font-weight: 400 !important;
            letter-spacing: -0.0125em !important;
            color: var(--text-premium) !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            outline: none !important;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: rgb(34, 197, 94) !important;
            box-shadow: var(--accent-glow-focus), 0 0 0 1px rgba(34, 197, 94, 0.3) !important;
            transform: translateY(-1px) !important;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
            font-weight: 400 !important;
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            width: 1rem !important;
            height: 1rem !important;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 0.25rem !important;
            transition: all 0.2s ease !important;
        }

        input[type="checkbox"]:checked {
            background: rgb(34, 197, 94) !important;
            border-color: rgb(34, 197, 94) !important;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3) !important;
        }

        /* Button styling */
        .bg-gray-800,
        .bg-indigo-600,
        button[type="submit"] {
            background: linear-gradient(135deg, rgb(34, 197, 94) 0%, rgb(21, 128, 61) 100%) !important;
            border: none !important;
            color: black !important;
            font-weight: 600 !important;
            letter-spacing: -0.0125em !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
            border-radius: 0.75rem !important;
            padding: 0.875rem 1rem !important;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.2), 
                transparent);
            transition: left 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 24px rgba(34, 197, 94, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
        }

        button:active {
            transform: translateY(0) !important;
        }

        /* Link styling */
        a {
            color: rgba(255, 255, 255, 0.7) !important;
            transition: all 0.2s ease !important;
            position: relative !important;
        }

        a:hover {
            color: rgb(34, 197, 94) !important;
        }

        a.underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: rgb(34, 197, 94);
            transition: width 0.3s ease;
        }

        a.underline:hover::after {
            width: 100%;
        }

        /* Error styling */
        .text-red-600 {
            color: rgb(248, 113, 113) !important;
        }

        .border-red-300 {
            border-color: rgba(239, 68, 68, 0.3) !important;
            background: rgba(239, 68, 68, 0.1) !important;
        }

        /* Terms and conditions styling */
        .flex.items-center label {
            display: flex !important;
            align-items: flex-start !important;
            gap: 0.5rem !important;
            font-size: 0.875rem !important;
            line-height: 1.5 !important;
        }

        .ms-2 {
            margin-left: 0 !important;
        }

        /* Admin link styling */
        .text-xs {
            font-size: 0.75rem !important;
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .text-xs:hover {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* Spacing adjustments */
        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-6 {
            margin-bottom: 2rem !important;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .authentication-card-container {
                max-width: 100%;
                margin: 1rem;
            }
            
            h1 {
                font-size: 1.5rem !important;
            }
        }

        /* Loading state */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.1), 
                transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>

    <div class="authentication-card-container">
        <x-authentication-card>
            <x-slot name="logo">
                <div class="authentication-card-logo">
                    <a href="/">Sanaa Co</a>
                </div>
            </x-slot>

            <h1>{{ __('Create your account') }}</h1>
            <p class="text-center text-sm text-gray-300/70 font-medium mb-8">Join Sanaa and start your journey with us.</p>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" id="register-form" class="space-y-6">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Full Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" 
                             required autofocus autocomplete="name" placeholder="Enter your full name" />
                </div>

                <div>
                    <x-label for="email" value="{{ __('Email Address') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" 
                             required autocomplete="username" placeholder="Enter your email address" />
                </div>

                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" 
                             required autocomplete="new-password" placeholder="Create a strong password" />
                </div>

                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" 
                             required autocomplete="new-password" placeholder="Confirm your password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div>
                        <x-label for="terms">
                            <div class="flex items-start">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms').'" class="underline text-sm text-gray-300 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policies.privacy-notice').'" class="underline text-sm text-gray-300 hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <a class="underline text-sm hover:text-green-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('login') }}">
                            {{ __('Already have an account?') }}
                        </a>

                        <a href="{{ route('admin.login') }}" class="text-xs hover:text-gray-300">{{ __('Admin Login') }}</a>
                    </div>

                    <x-button class="ms-4" id="submit-btn">
                        <span class="button-text">{{ __('Create Account') }}</span>
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>

    <script>
        // Mode Toggle Functionality
        const loginToggle = document.getElementById('login-toggle');
        const signupToggle = document.getElementById('signup-toggle');
        const toggleIndicator = document.querySelector('.toggle-indicator');
        const formTitle = document.getElementById('form-title');
        const formSubtitle = document.getElementById('form-subtitle');
        const authForm = document.getElementById('auth-form');
        const submitBtn = document.getElementById('submit-btn');
        const buttonText = submitBtn.querySelector('.button-text');
        const switchModeText = document.getElementById('switch-mode');
        const nameField = document.getElementById('name-field');
        const confirmPasswordField = document.getElementById('confirm-password-field');
        const termsField = document.getElementById('terms-field');
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const rememberSection = document.getElementById('remember-section');
        const nameInput = document.getElementById('name');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const termsInput = document.getElementById('terms');
        
        let isSignupMode = true; // Start in signup mode

        function switchToSignup() {
            isSignupMode = true;
            
            // Update toggle appearance
            loginToggle.classList.remove('toggle-active');
            signupToggle.classList.add('toggle-active');
            toggleIndicator.classList.add('signup-mode');
            loginToggle.classList.add('text-gray-400');
            signupToggle.classList.remove('text-gray-400');
            
            // Update text content
            formTitle.textContent = 'Create your account';
            formSubtitle.textContent = 'Join Sanaa and start your journey with us.';
            buttonText.textContent = 'Create Account';
            switchModeText.textContent = 'Already have an account?';
            
            // Show signup fields
            nameField.classList.remove('hidden');
            nameField.classList.add('field-enter');
            confirmPasswordField.classList.remove('hidden');
            confirmPasswordField.classList.add('field-enter');
            if (termsField) {
                termsField.classList.remove('hidden');
                termsField.classList.add('field-enter');
            }
            
            // Hide login-specific elements
            forgotPasswordLink.style.opacity = '0';
            forgotPasswordLink.style.pointerEvents = 'none';
            rememberSection.style.opacity = '0';
            rememberSection.style.pointerEvents = 'none';
            
            // Update form attributes
            authForm.action = '{{ route("register") }}';
            nameInput.required = true;
            confirmPasswordInput.required = true;
            if (termsInput) termsInput.required = true;
            
            // Update password autocomplete
            document.getElementById('password').setAttribute('autocomplete', 'new-password');
        }

        function switchToLogin() {
            isSignupMode = false;
            
            // Update toggle appearance
            signupToggle.classList.remove('toggle-active');
            loginToggle.classList.add('toggle-active');
            toggleIndicator.classList.remove('signup-mode');
            signupToggle.classList.add('text-gray-400');
            loginToggle.classList.remove('text-gray-400');
            
            // Update text content
            formTitle.textContent = 'Welcome back';
            formSubtitle.textContent = 'Sign in to continue to your dashboard.';
            buttonText.textContent = 'Sign In';
            switchModeText.textContent = 'Need an account?';
            
            // Hide signup fields
            setTimeout(() => {
                nameField.classList.add('hidden');
                confirmPasswordField.classList.add('hidden');
                if (termsField) termsField.classList.add('hidden');
            }, 300);
            nameField.classList.remove('field-enter');
            nameField.classList.add('field-exit');
            confirmPasswordField.classList.remove('field-enter');
            confirmPasswordField.classList.add('field-exit');
            if (termsField) {
                termsField.classList.remove('field-enter');
                termsField.classList.add('field-exit');
            }
            
            // Show login-specific elements
            forgotPasswordLink.style.opacity = '1';
            forgotPasswordLink.style.pointerEvents = 'auto';
            rememberSection.style.opacity = '1';
            rememberSection.style.pointerEvents = 'auto';
            
            // Update form attributes
            authForm.action = '{{ route("login") }}';
            nameInput.required = false;
            confirmPasswordInput.required = false;
            if (termsInput) termsInput.required = false;
            
            // Update password autocomplete
            document.getElementById('password').setAttribute('autocomplete', 'current-password');
        }

        // Event listeners
        loginToggle.addEventListener('click', () => {
            if (isSignupMode) switchToLogin();
        });

        signupToggle.addEventListener('click', () => {
            if (!isSignupMode) switchToSignup();
        });

        switchModeText.addEventListener('click', () => {
            if (isSignupMode) {
                switchToLogin();
            } else {
                switchToSignup();
            }
        });

        // Enhanced form submission with loading state
        const form = document.getElementById('auth-form');
        
        form.addEventListener('submit', function(e) {
            const currentButtonText = isSignupMode ? 'Creating account...' : 'Signing in...';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            buttonText.textContent = currentButtonText;
            
            // Add subtle animation
            submitBtn.style.transform = 'translateY(0)';
            submitBtn.style.boxShadow = '0 2px 8px rgba(34, 197, 94, 0.2)';
        });

        // Enhanced input interactions
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-1px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });

            // Add subtle typing animation
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.background = 'rgba(255, 255, 255, 0.04)';
                } else {
                    this.style.background = 'rgba(255, 255, 255, 0.03)';
                }
            });
        });

        // Subtle parallax effect on mouse move
        const card = document.querySelector('.glass-card');
        let isHovering = false;
        
        card.addEventListener('mouseenter', () => isHovering = true);
        card.addEventListener('mouseleave', () => {
            isHovering = false;
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
        
        document.addEventListener('mousemove', function(e) {
            if (!isHovering) return;
            
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            const rotateX = (y / rect.height) * -1.5;
            const rotateY = (x / rect.width) * 1.5;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
        });
    </script>
</x-auth-layout>