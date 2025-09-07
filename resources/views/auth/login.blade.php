@section('title', 'Sign In | ' . config('app.name'))
<x-auth-layout>
    <style>
        /* MacBook-inspired enhancements */
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

        .premium-container {
            position: relative;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .premium-card {
            position: relative;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .premium-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1rem;
            padding: 1px;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.1) 0%, 
                rgba(255, 255, 255, 0.05) 50%, 
                rgba(255, 255, 255, 0.02) 100%);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: subtract;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            pointer-events: none;
        }

        .logo-enhanced {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .logo-enhanced::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 0.5rem;
            background: linear-gradient(135deg, transparent 0%, rgba(34, 197, 94, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .logo-enhanced:hover::after {
            opacity: 1;
        }

        .logo-enhanced:hover {
            transform: translateY(-1px);
        }

        .logo-dot-enhanced {
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.6), 0 0 16px rgba(34, 197, 94, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { 
                opacity: 1; 
                transform: scale(1); 
                box-shadow: 0 0 8px rgba(34, 197, 94, 0.6), 0 0 16px rgba(34, 197, 94, 0.3);
            }
            50% { 
                opacity: 0.8; 
                transform: scale(1.05); 
                box-shadow: 0 0 12px rgba(34, 197, 94, 0.8), 0 0 24px rgba(34, 197, 94, 0.4);
            }
        }

        .form-enhanced {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .input-enhanced {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            font-size: 15px !important;
            font-weight: 400 !important;
            letter-spacing: -0.1px !important;
        }

        .input-enhanced:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: rgb(34, 197, 94) !important;
            box-shadow: var(--accent-glow-focus), 0 0 0 1px rgba(34, 197, 94, 0.3) !important;
            transform: translateY(-1px) !important;
        }

        .input-enhanced::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
            font-weight: 400 !important;
        }

        .label-enhanced {
            font-size: 13px !important;
            font-weight: 500 !important;
            letter-spacing: -0.05px !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .button-enhanced {
            background: linear-gradient(135deg, rgb(34, 197, 94) 0%, rgb(21, 128, 61) 100%) !important;
            border: none !important;
            font-weight: 600 !important;
            letter-spacing: -0.1px !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
        }

        .button-enhanced::before {
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

        .button-enhanced:hover::before {
            left: 100%;
        }

        .button-enhanced:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 24px rgba(34, 197, 94, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
        }

        .button-enhanced:active {
            transform: translateY(0) !important;
        }

        .checkbox-enhanced {
            width: 16px !important;
            height: 16px !important;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            transition: all 0.2s ease !important;
        }

        .checkbox-enhanced:checked {
            background: rgb(34, 197, 94) !important;
            border-color: rgb(34, 197, 94) !important;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3) !important;
        }

        .link-enhanced {
            transition: all 0.2s ease !important;
            position: relative !important;
        }

        .link-enhanced::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: rgb(34, 197, 94);
            transition: width 0.3s ease;
        }

        .link-enhanced:hover::after {
            width: 100%;
        }

        .password-toggle-enhanced {
            color: rgba(255, 255, 255, 0.4) !important;
            transition: all 0.2s ease !important;
        }

        .password-toggle-enhanced:hover {
            color: rgba(255, 255, 255, 0.7) !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }

        .validation-enhanced {
            background: rgba(239, 68, 68, 0.1) !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
            color: rgb(248, 113, 113) !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            font-size: 14px !important;
            animation: shake 0.5s ease-in-out !important;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }

        .status-enhanced {
            background: rgba(34, 197, 94, 0.1) !important;
            border: 1px solid rgba(34, 197, 94, 0.3) !important;
            color: rgb(74, 222, 128) !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            font-size: 14px !important;
        }

        /* Subtle parallax effect */
        .premium-card:hover {
            transform: perspective(1000px) rotateX(1deg) rotateY(1deg);
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

    <div class="w-full max-w-md premium-container">
        <div class="mb-8 text-center">
            <a href="/" class="logo-enhanced inline-flex items-center justify-center text-2xl font-semibold tracking-tight text-white hover:text-green-400 transition-colors p-3 rounded-xl">
                Sanaa Co.
                <span class="logo-dot-enhanced ml-1 inline-block w-1.5 h-1.5 rounded-full bg-green-500 align-super"></span>
            </a>
        </div>

        <div class="premium-card relative bg-neutral-950/70 backdrop-blur-xl border border-white/12 rounded-2xl shadow-2xl shadow-black/40 overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-semibold leading-tight text-white/95 tracking-tight">Welcome back</h1>
                <p class="mt-2 text-sm text-gray-400/80 font-medium">Sign in to continue to your dashboard.</p>

                <x-validation-errors class="mb-6 validation-enhanced" />

                @session('status')
                    <div class="mb-4 font-medium text-sm status-enhanced">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}" class="mt-6 form-enhanced" id="login-form">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="email" class="label-enhanced block text-sm text-gray-300">Email</label>
                            <input id="email" name="email" type="email" inputmode="email" autocomplete="username" required autofocus
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email"
                                   class="input-enhanced mt-2 w-full rounded-xl bg-black/40 text-white placeholder-gray-500 border border-white/10 focus:border-green-500 focus:ring-2 focus:ring-green-500/40 px-4 py-3.5 transition" />
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="label-enhanced block text-sm text-gray-300">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-enhanced text-xs text-gray-400 hover:text-green-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500/50 rounded px-2 py-1">Forgot password?</a>
                                @endif
                            </div>
                            <div class="relative mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       placeholder="Enter your password"
                                       class="input-enhanced w-full rounded-xl bg-black/40 text-white placeholder-gray-500 border border-white/10 focus:border-green-500 focus:ring-2 focus:ring-green-500/40 px-4 py-3.5 pr-12 transition" />
                                <button type="button" id="toggle-password" aria-label="Show password"
                                        class="password-toggle-enhanced absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500/50 rounded-lg">
                                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center gap-2 select-none cursor-pointer">
                                <input id="remember_me" name="remember" type="checkbox" class="checkbox-enhanced h-4 w-4 rounded border-white/20 bg-black/40 text-green-500 focus:ring-green-500/60 focus:ring-2" />
                                <span class="text-sm text-gray-400 font-medium">Remember me</span>
                            </label>

                            <a href="{{ route('register') }}" class="link-enhanced text-sm text-gray-400 hover:text-green-400">Create account</a>
                        </div>

                        <button type="submit" id="submit-btn" class="button-enhanced w-full inline-flex items-center justify-center rounded-xl bg-green-500 text-black font-semibold px-4 py-3.5 hover:bg-green-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500/60 active:bg-green-600 transition">
                            <span class="button-text">Sign In</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-6 text-center text-xs text-gray-500 font-medium">
            By continuing you agree to our 
            <a href="{{ route('terms') }}" class="link-enhanced underline hover:text-green-400 transition-colors">Terms of Service</a>.
        </p>
    </div>

    <script>
        (function(){
            // Enhanced password toggle with smooth animations
            const btn = document.getElementById('toggle-password');
            if (!btn) return;
            
            btn.addEventListener('click', function(){
                const input = document.getElementById('password');
                const icon = document.getElementById('eye-icon');
                const isPassword = input.type === 'password';
                
                // Add transition effect
                icon.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    if (isPassword) {
                        input.type = 'text';
                        btn.setAttribute('aria-label','Hide password');
                        icon.innerHTML = '<path d="M2.808 1.394 1.394 2.808l3.115 3.115C2.714 7.18 1.455 9.2 1 12c1.73 4.39 6 7.5 11 7.5 2.11 0 4.07-.56 5.78-1.54l3.828 3.828 1.414-1.414L2.808 1.394zM12 6.5c.75 0 1.45.2 2.06.54l-1.5 1.5a3 3 0 0 0-4.06 4.06l-1.5 1.5A5 5 0 0 1 12 6.5zm0 12.5c-5 0-9.27-3.11-11-7.5a13.06 13.06 0 0 1 5.006-6.02l2.04 2.04A5 5 0 0 0 17.48 15.9 12.5 12.5 0 0 1 12 19z"/>';
                    } else {
                        input.type = 'password';
                        btn.setAttribute('aria-label','Show password');
                        icon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z"/>';
                    }
                    icon.style.transform = 'scale(1)';
                }, 150);
            });

            // Enhanced form submission with loading state
            const form = document.getElementById('login-form');
            const submitBtn = document.getElementById('submit-btn');
            const buttonText = submitBtn.querySelector('.button-text');
            
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                buttonText.textContent = 'Signing in...';
                
                // Add subtle animation
                submitBtn.style.transform = 'translateY(0)';
                submitBtn.style.boxShadow = '0 2px 8px rgba(34, 197, 94, 0.2)';
            });

            // Enhanced input interactions
            const inputs = document.querySelectorAll('.input-enhanced');
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
            const card = document.querySelector('.premium-card');
            let isHovering = false;
            
            card.addEventListener('mouseenter', () => isHovering = true);
            card.addEventListener('mouseleave', () => {
                isHovering = false;
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
            
            document.addEventListener('mousemove', function(e) {
                if (!isHovering) return;
                
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                const rotateX = (y / rect.height) * -2;
                const rotateY = (x / rect.width) * 2;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            // Enhanced checkbox animation
            const checkbox = document.getElementById('remember_me');
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    this.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                }
            });
        })();
    </script>
</x-auth-layout>