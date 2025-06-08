<nav class="bg-white border-b border-gray-200 fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Logo / Brand -->
        <div class="flex items-center justify-between py-4">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900">
                    <!-- Replace with your logo image if you wish -->
                    {{ config('app.name', 'Sanaa') }}
                </a>
            </div>
            <!-- Primary Nav -->
            <div class="hidden md:flex space-x-8 ml-10">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Home</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-gray-900">About</a>
                <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-gray-900">Blog</a>
            </div>
            <!-- Secondary Nav / Auth Links -->
            <div class="flex space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Sign In</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Add padding to the content below to prevent overlap -->
<div style="padding-top: 64px;">
    <!-- Your main content goes here -->
</div>