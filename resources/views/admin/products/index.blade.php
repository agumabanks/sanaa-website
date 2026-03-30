<x-admin-dashboard-layout title="Products">
    <x-slot name="header">Products & Offerings</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Manage your products and service offerings</p>
            </div>
            <button onclick="document.getElementById('create-product-modal').classList.remove('hidden')" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Product
            </button>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $items->count() }}</p>
                        <p class="text-sm text-gray-500">Total Products</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $items->where('type', 'product')->count() }}</p>
                        <p class="text-sm text-gray-500">Products</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $items->where('type', 'service')->count() }}</p>
                        <p class="text-sm text-gray-500">Services</p>
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
                        <p class="text-2xl font-semibold text-gray-900">{{ $items->where('featured', true)->count() }}</p>
                        <p class="text-sm text-gray-500">Featured</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="content-card p-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1">
                    <input type="text" id="product-search" placeholder="Search products..." class="input-field pl-10">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select id="type-filter" class="input-field w-full sm:w-48">
                    <option value="">All Types</option>
                    <option value="product">Products</option>
                    <option value="service">Services</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="products-grid">
            @forelse($items as $item)
                <div class="content-card overflow-hidden group product-item" data-name="{{ strtolower($item->name) }}" data-type="{{ $item->type ?? 'product' }}">
                    @if($item->image)
                        <div class="aspect-video bg-gray-100 overflow-hidden">
                            <img src="{{ cdn_storage($item->image) }}" class="w-full h-full object-cover group-hover:scale-105 apple-transition" alt="{{ $item->name }}">
                        </div>
                    @else
                        <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="badge {{ ($item->type ?? 'product') === 'product' ? 'badge-info' : 'badge-success' }}">
                                    {{ ucfirst($item->type ?? 'Product') }}
                                </span>
                                @if($item->featured)
                                    <span class="badge bg-amber-50 text-amber-700">Featured</span>
                                @endif
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ Str::limit($item->description, 80) }}</p>
                        
                        @if($item->price)
                            <p class="text-lg font-semibold text-gray-900 mt-3">${{ number_format($item->price, 2) }}</p>
                        @endif

                        <div class="flex items-center gap-2 mt-4 pt-4 border-t border-gray-100">
                            <button onclick="editProduct({{ json_encode($item) }})" class="flex-1 btn-secondary text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <form method="POST" action="{{ route('dashboard.offering.destroy', $item) }}" onsubmit="return confirm('Delete this product?')">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">No products yet</h3>
                        <p class="text-gray-500 mt-1">Add your first product or service</p>
                        <button onclick="document.getElementById('create-product-modal').classList.remove('hidden')" class="btn-primary mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Product
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Product Modal -->
    <div id="create-product-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('create-product-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg apple-shadow-lg my-8" onclick="event.stopPropagation()">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Add New Product</h3>
                    <p class="text-sm text-gray-500 mt-1">Create a new product or service offering</p>
                </div>
                <form method="POST" action="{{ route('dashboard.offering.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" required class="input-field" placeholder="Product name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select name="type" class="input-field">
                            <option value="product">Product</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3" class="input-field" placeholder="Product description"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <input type="number" name="price" step="0.01" class="input-field" placeholder="0.00">
                        </div>
                        <div class="flex items-center gap-3 pt-8">
                            <input type="checkbox" id="featured_create" name="featured" value="1" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="featured_create" class="text-sm text-gray-700">Featured</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <input type="file" name="image" accept="image/*" class="input-field">
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('create-product-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="edit-product-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('edit-product-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg apple-shadow-lg my-8" onclick="event.stopPropagation()">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Product</h3>
                    <p class="text-sm text-gray-500 mt-1">Update product information</p>
                </div>
                <form id="edit-product-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="edit_name" name="name" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select id="edit_type" name="type" class="input-field">
                            <option value="product">Product</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="edit_description" name="description" rows="3" class="input-field"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <input type="number" id="edit_price" name="price" step="0.01" class="input-field">
                        </div>
                        <div class="flex items-center gap-3 pt-8">
                            <input type="checkbox" id="edit_featured" name="featured" value="1" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="edit_featured" class="text-sm text-gray-700">Featured</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <input type="file" name="image" accept="image/*" class="input-field">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('edit-product-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function editProduct(item) {
            document.getElementById('edit-product-form').action = `/dashboard/offering/${item.id}`;
            document.getElementById('edit_name').value = item.name || '';
            document.getElementById('edit_type').value = item.type || 'product';
            document.getElementById('edit_description').value = item.description || '';
            document.getElementById('edit_price').value = item.price || '';
            document.getElementById('edit_featured').checked = item.featured || false;
            document.getElementById('edit-product-modal').classList.remove('hidden');
        }

        const searchInput = document.getElementById('product-search');
        const typeFilter = document.getElementById('type-filter');
        const productsGrid = document.getElementById('products-grid');

        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const typeValue = typeFilter.value;

            productsGrid?.querySelectorAll('.product-item').forEach(item => {
                const name = item.dataset.name || '';
                const type = item.dataset.type || '';

                const matchesSearch = name.includes(searchTerm);
                const matchesType = !typeValue || type === typeValue;

                item.style.display = matchesSearch && matchesType ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', filterProducts);
        typeFilter?.addEventListener('change', filterProducts);
    </script>
    @endpush
</x-admin-dashboard-layout>
