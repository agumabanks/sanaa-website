<footer class="bg-gray-50 border-t border-gray-200 py-8 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between">
            <!-- Left side: Links -->
            <div class="mb-4 md:mb-0">
                <h4 class="font-semibold mb-2 text-gray-700">Company</h4>
                <ul class="space-y-1">
                    <li><a href="#" class="text-gray-600 hover:text-gray-800">About</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-800">Policies</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-800">Careers</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-800">Blog</a></li>
                </ul>
            </div>
            <!-- Right side: Social / Extra Info -->
            <div>
                <h4 class="font-semibold mb-2 text-gray-700">Support</h4>
                <ul class="space-y-1">
                    <li><a href="#" class="text-gray-600 hover:text-gray-800">Contact Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-800">Help Center</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-800">System Status</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500">
            © {{ now()->year }} {{ config('app.name', 'Sanaa') }}. All rights reserved.
        </div>
    </div>
</footer>
