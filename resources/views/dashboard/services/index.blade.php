<x-dashboard-layout title="Services">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Services</h2>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input id="serviceSearch" type="text" placeholder="Search services" class="w-64 rounded-lg border border-gray-300 bg-white text-sm py-2 pl-9 pr-3 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                </div>
                <a href="{{ route('dashboard.services.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    New Service
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 text-red-900 px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($services->count())
                {{-- Services are paginated in the controller (20 per page) --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Manage Services</h3>
                        <span class="text-sm text-gray-500">{{ $services->total() }} total</span>
                    </div>
                    <div class="divide-y divide-gray-100" id="servicesList">
                        @foreach($services as $service)
                        <div class="p-6" data-name="{{ strtolower($service->name) }}">
                            <div class="flex items-start gap-4">
                                @if($service->icon)
                                    <div class="flex items-center justify-center w-12 h-12 bg-emerald-100 rounded-lg">
                                        <i class="text-emerald-600 text-xl {{ $service->icon }}"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs px-2 py-1 rounded-full border {{ $service->active ? 'border-emerald-300 text-emerald-700 bg-emerald-50' : 'border-gray-300 text-gray-700 bg-gray-50' }}">{{ $service->active ? 'Active' : 'Inactive' }}</span>
                                            <span class="text-xs text-gray-500">{{ $service->created_at->format('M j, Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('dashboard.services.show', $service) }}" class="text-xs px-2 py-1 rounded border border-gray-300 text-gray-700 hover:text-black hover:border-gray-400">View</a>
                                            <a href="{{ route('dashboard.services.edit', $service) }}" class="text-xs px-2 py-1 rounded border border-gray-300 text-gray-700 hover:text-black hover:border-gray-400">Edit</a>
                                        </div>
                                    </div>

                                    <h4 class="text-lg font-medium text-gray-900">{{ $service->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($service->description, 100) }}</p>
                                    @if($service->price)
                                        <p class="text-sm font-medium text-emerald-600 mt-2">${{ number_format($service->price, 2) }}</p>
                                    @endif

                                    <div class="flex items-center gap-3 mt-3">
                                        <form method="POST" action="{{ route('dashboard.services.destroy', $service) }}" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-lg bg-red-600 text-white px-3 py-2 text-xs font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="p-6">
                        {{ $services->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No services</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new service.</p>
                    <div class="mt-6">
                        <a href="{{ route('dashboard.services.create') }}" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2 text-sm font-medium hover:bg-emerald-700">Create Service</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Simple search for Manage Services list
        const serviceSearch = document.getElementById('serviceSearch');
        const servicesList = document.getElementById('servicesList');
        if (serviceSearch && servicesList) {
            serviceSearch.addEventListener('input', () => {
                const q = (serviceSearch.value || '').toLowerCase().trim();
                servicesList.querySelectorAll('[data-name]')?.forEach(el => {
                    const n = el.getAttribute('data-name') || '';
                    el.style.display = n.includes(q) ? '' : 'none';
                });
            });
        }
    </script>
    @endpush
</x-dashboard-layout>