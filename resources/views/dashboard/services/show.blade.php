<x-dashboard-layout title="View Service">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">View Service</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.services.edit', $service) }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-medium py-2 px-3 hover:bg-gray-50">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
                    Edit
                </a>
                <a href="{{ route('dashboard.services.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-medium py-2 px-3 hover:bg-gray-50">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                    Back to Services
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        @if($service->icon)
                            <div class="flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-lg">
                                <i class="text-emerald-600 text-2xl {{ $service->icon }}"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900">{{ $service->name }}</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs px-2 py-1 rounded-full border {{ $service->active ? 'border-emerald-300 text-emerald-700 bg-emerald-50' : 'border-gray-300 text-gray-700 bg-gray-50' }}">{{ $service->active ? 'Active' : 'Inactive' }}</span>
                                <span class="text-sm text-gray-500">Created {{ $service->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Description</h4>
                        <p class="text-gray-700 leading-relaxed">{{ $service->description }}</p>
                    </div>

                    @if($service->price)
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Pricing</h4>
                            <p class="text-2xl font-bold text-emerald-600">${{ number_format($service->price, 2) }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-100">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Service ID</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->id }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Last Updated</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->updated_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between rounded-b-2xl">
                    <div class="text-sm text-gray-500">
                        This service {{ $service->active ? 'is visible to the public' : 'is hidden from the public' }}
                    </div>
                    <div class="flex items-center gap-3">
                        <form method="POST" action="{{ route('dashboard.services.destroy', $service) }}" onsubmit="return confirm('Are you sure you want to delete this service? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center rounded-lg bg-red-600 text-white px-4 py-2 text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">Delete Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>