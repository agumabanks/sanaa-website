<x-admin-dashboard-layout title="Services">
    <x-slot name="header">Services Management</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Manage services offered by your business</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('dashboard.services.page') }}" class="btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Page Settings
                </a>
                <a href="{{ route('dashboard.services.create') }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Service
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $services->count() }}</p>
                        <p class="text-sm text-gray-500">Total Services</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $services->where('active', true)->count() }}</p>
                        <p class="text-sm text-gray-500">Active</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $services->where('featured', true)->count() }}</p>
                        <p class="text-sm text-gray-500">Featured</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="content-card p-4">
            <div class="relative">
                <input type="text" id="service-search" placeholder="Search services..." class="input-field pl-10">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="services-grid">
            @forelse($services as $service)
                <div class="content-card overflow-hidden group service-item" data-name="{{ strtolower($service->name ?? $service->title ?? '') }}">
                    @if($service->image)
                        <div class="aspect-video bg-gray-100 overflow-hidden">
                            <img src="{{ cdn_storage($service->image) }}" class="w-full h-full object-cover group-hover:scale-105 apple-transition" alt="{{ $service->name ?? $service->title }}">
                        </div>
                    @else
                        <div class="aspect-video bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            @if($service->featured ?? false)
                                <span class="badge bg-amber-50 text-amber-700">Featured</span>
                            @endif
                            @if($service->active ?? true)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-gray">Inactive</span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-900">{{ $service->name ?? $service->title }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ Str::limit($service->description ?? $service->excerpt, 80) }}</p>
                        
                        @if($service->price ?? false)
                            <p class="text-lg font-semibold text-gray-900 mt-3">${{ number_format($service->price, 2) }}</p>
                        @endif

                        <div class="flex items-center gap-2 mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('dashboard.services.edit', $service) }}" class="flex-1 btn-secondary text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('dashboard.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 rounded-lg hover:bg-red-50 text-gray-500 hover:text-red-600 apple-transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="content-card p-12 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">No services yet</h3>
                        <p class="text-gray-500 mt-1">Add your first service</p>
                        <a href="{{ route('dashboard.services.create') }}" class="btn-primary mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Service
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @push('scripts')
    <script>
        const searchInput = document.getElementById('service-search');
        const servicesGrid = document.getElementById('services-grid');

        searchInput?.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            servicesGrid?.querySelectorAll('.service-item').forEach(item => {
                const name = item.dataset.name || '';
                item.style.display = name.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
    @endpush
</x-admin-dashboard-layout>
