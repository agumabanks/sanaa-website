@section('title', 'Admin Login | ' . config('app.name'))
<x-guest-layout>
    <style>
        .sj-wrap{min-height:100vh;background:#000;display:grid;place-items:center;padding:2rem}
        .sj-card{width:100%;max-width:480px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:20px;padding:32px;color:#fff;backdrop-filter:blur(10px)}
        .sj-logo{display:flex;justify-content:center;margin-bottom:16px}
        .sj-title{font-weight:200;letter-spacing:.08em;text-align:center;font-size:28px;margin-bottom:6px}
        .sj-sub{color:#9ca3af;text-align:center;font-size:12px;margin-bottom:24px}
        .sj-input{width:100%;background:transparent;border:1px solid rgba(255,255,255,0.12);border-radius:12px;color:#fff;padding:12px 14px;font-size:14px;outline:none}
        .sj-input:focus{border-color:#10b981;box-shadow:0 0 0 3px rgba(16,185,129,.15)}
        .sj-label{display:block;color:#d1d5db;font-size:12px;margin:12px 0 6px}
        .sj-row{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
        .sj-cta{display:inline-flex;align-items:center;justify-content:center;width:100%;background:#10b981;color:#000;border:0;border-radius:999px;padding:12px 16px;font-weight:600;margin-top:18px}
        .sj-cta:hover{background:#34d399}
        .sj-link{color:#9ca3af;text-decoration:none;font-size:12px}
        .sj-link:hover{color:#fff}
        .sj-error{margin-bottom:8px;color:#fca5a5;font-size:12px}
    </style>

    <div class="sj-wrap">
        <div class="sj-card">
            <div class="sj-logo">
                <img src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="{{ config('app.name') }}" style="height:28px;filter:invert(1)">
            </div>
            <div class="sj-title">Sanaa Admin</div>
            <div class="sj-sub">Think different. Keep it simple.</div>

            <x-validation-errors class="sj-error" />

            @session('status')
                <div class="sj-error">{{ $value }}</div>
            @endsession

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <label class="sj-label" for="email">Email</label>
                <input id="email" class="sj-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />

                <label class="sj-label" for="password">Password</label>
                <input id="password" class="sj-input" type="password" name="password" required autocomplete="current-password" />

                <div class="sj-row">
                    <label class="inline-flex items-center gap-2 text-xs text-gray-300">
                        <x-checkbox id="remember_me" name="remember" />
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="sj-link" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button class="sj-cta" type="submit">Log in</button>
            </form>
        </div>
    </div>
</x-guest-layout>
