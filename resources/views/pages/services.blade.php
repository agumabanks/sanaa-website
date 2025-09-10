<x-app-layout title="Services | {{ config('app.name') }}">
    <x-slot name="meta-description">
        Explore our comprehensive range of services at Sanaa Co., including content generation, web development, consulting, and more. Discover how we empower businesses with innovative digital solutions.
    </x-slot>

    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Our Services</h1>
                <p class="mt-1 text-lg text-gray-600">Discover the full range of services we offer to empower your business with modern digital infrastructure.</p>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                @if($services->isEmpty())
                    <div class="text-center py-12">
                        <h3 class="text-lg font-medium text-gray-900">No services available</h3>
                        <p class="mt-1 text-sm text-gray-500">Check back later for updates.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($services as $service)
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-6">
                                    @if($service->icon)
                                        <div class="flex items-center justify-center w-12 h-12 bg-emerald-100 rounded-md mb-4">
                                            <i class="text-emerald-600 text-xl">{{ $service->icon }}</i>
                                        </div>
                                    @endif
                                    <h3 class="text-lg font-medium text-gray-900">{{ $service->name }}</h3>
                                    <p class="mt-2 text-sm text-gray-500">{{ $service->description }}</p>
                                    @if($service->price)
                                        <p class="mt-4 font-medium text-emerald-600">${{ number_format($service->price, 2) }}</p>
                                    @endif
                                    <a href="{{ route('contact') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>
    </div>
</x-app-layout>
