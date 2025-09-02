@section('title', 'Sign In | ' . config('app.name'))
<x-auth-layout>
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <a href="/" class="inline-flex items-center justify-center text-2xl font-semibold tracking-tight text-white hover:text-green-400 transition-colors">
                Sanaa Co.
                <span class="ml-1 inline-block w-1.5 h-1.5 rounded-full bg-green-500 align-super"></span>
            </a>
        </div>

        <div class="relative bg-neutral-950/60 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl shadow-black/30 overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-semibold leading-tight">Welcome back</h1>
                <p class="mt-2 text-sm text-gray-400">Sign in to continue to your dashboard.</p>

                <x-validation-errors class="mb-6" />

                @session('status')
                    <div class="mb-4 font-medium text-sm text-emerald-400">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}" class="mt-6">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm text-gray-300">Email</label>
                            <input id="email" name="email" type="email" inputmode="email" autocomplete="username" required autofocus
                                   value="{{ old('email') }}"
                                   class="mt-2 w-full rounded-xl bg-black/40 text-white placeholder-gray-500 border border-white/10 focus:border-green-500 focus:ring-2 focus:ring-green-500/40 px-4 py-3 transition" />
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm text-gray-300">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-xs text-gray-400 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500/50 rounded px-1">Forgot?</a>
                                @endif
                            </div>
                            <div class="relative mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       class="w-full rounded-xl bg-black/40 text-white placeholder-gray-500 border border-white/10 focus:border-green-500 focus:ring-2 focus:ring-green-500/40 px-4 py-3 pr-12 transition" />
                                <button type="button" id="toggle-password" aria-label="Show password"
                                        class="absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500/50 rounded">
                                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center gap-2 select-none">
                                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-white/20 bg-black/40 text-green-500 focus:ring-green-500/60 focus:ring-2" />
                                <span class="text-sm text-gray-400">Remember me</span>
                            </label>

                            <a href="{{ route('register') }}" class="text-sm text-gray-400 hover:text-white">Create account</a>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-green-500 text-black font-semibold px-4 py-3 hover:bg-green-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500/60 active:bg-green-600 transition">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-6 text-center text-xs text-gray-500">By continuing you agree to our <a href="{{ route('terms') }}" class="underline hover:text-white">Terms</a>.</p>
    </div>

    <script>
        (function(){
            const btn = document.getElementById('toggle-password');
            if (!btn) return;
            btn.addEventListener('click', function(){
                const input = document.getElementById('password');
                const icon = document.getElementById('eye-icon');
                if (input.type === 'password') {
                    input.type = 'text';
                    btn.setAttribute('aria-label','Hide password');
                    icon.innerHTML = '<path d="M2.808 1.394 1.394 2.808l3.115 3.115C2.714 7.18 1.455 9.2 1 12c1.73 4.39 6 7.5 11 7.5 2.11 0 4.07-.56 5.78-1.54l3.828 3.828 1.414-1.414L2.808 1.394zM12 6.5c.75 0 1.45.2 2.06.54l-1.5 1.5a3 3 0 0 0-4.06 4.06l-1.5 1.5A5 5 0 0 1 12 6.5zm0 12.5c-5 0-9.27-3.11-11-7.5a13.06 13.06 0 0 1 5.006-6.02l2.04 2.04A5 5 0 0 0 17.48 15.9 12.5 12.5 0 0 1 12 19z"/>';
                } else {
                    input.type = 'password';
                    btn.setAttribute('aria-label','Show password');
                    icon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z"/>';
                }
            });
        })();
    </script>
</x-auth-layout>
