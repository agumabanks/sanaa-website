@extends('layouts.dashboard')

@section('title', 'Policy Management')

@push('styles')
<style>
.policy-table {
    border-collapse: separate;
    border-spacing: 0;
}

.policy-table th {
    background: #f9fafb;
    border-bottom: 2px solid #e5e7eb;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #374151;
}

.policy-table td {
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.policy-table tbody tr:hover {
    background: #f9fafb;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 500;
}

.category-legal { background: #dbeafe; color: #1e40af; }
.category-privacy { background: #dcfce7; color: #166534; }
.category-licenses { background: #ede9fe; color: #5b21b6; }
.category-corporate { background: #fef3c7; color: #92400e; }

.action-btn {
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-edit {
    background: #3b82f6;
    color: white;
}

.btn-edit:hover {
    background: #2563eb;
}

.btn-delete {
    background: #ef4444;
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
}

.bulk-actions {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1rem;
}

.search-form {
    max-width: 300px;
}

.search-input {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.filter-btn {
    padding: 0.375rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background: white;
    color: #6b7280;
    text-decoration: none;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.filter-btn:hover,
.filter-btn.active {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
}

.pagination-links {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination-links a,
.pagination-links span {
    padding: 0.5rem 0.75rem;
    margin: 0 0.25rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    text-decoration: none;
    color: #6b7280;
    transition: all 0.2s ease;
}

.pagination-links a:hover,
.pagination-links .active {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
}

@media (max-width: 768px) {
    .policy-table {
        font-size: 0.875rem;
    }

    .policy-table th,
    .policy-table td {
        padding: 0.5rem;
    }

    .filters {
        flex-direction: column;
    }

    .search-form {
        max-width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Policy Management</h1>
                <p class="mt-2 text-gray-600">Manage legal documents, policies, and compliance information</p>
            </div>
            <a href="{{ route('dashboard.policies.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
                Add New Policy
            </a>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <!-- Category Filters -->
                <div class="filters">
                    <a href="{{ route('dashboard.policies') }}"
                       class="filter-btn {{ !$category ? 'active' : '' }}">
                        All Categories
                    </a>
                    @foreach($categories as $catKey => $catName)
                    <a href="{{ route('dashboard.policies', ['category' => $catKey]) }}"
                       class="filter-btn {{ $category === $catKey ? 'active' : '' }}">
                        {{ $catName }}
                    </a>
                    @endforeach
                </div>

                <!-- Search -->
                <form method="GET" class="search-form">
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Search policies..."
                           class="search-input">
                </form>
            </div>
        </div>

        <!-- Bulk Actions -->
        <form id="bulkForm" method="POST" action="{{ route('dashboard.policies.bulk-update') }}">
            @csrf
            <div class="bulk-actions hidden" id="bulkActions">
                <div class="flex items-center justify-between">
                    <span id="selectedCount" class="text-sm text-gray-600">0 policies selected</span>
                    <div class="flex gap-2">
                        <button type="button" onclick="bulkUpdate('status', true)"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                            Activate
                        </button>
                        <button type="button" onclick="bulkUpdate('status', false)"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                            Deactivate
                        </button>
                        <button type="button" onclick="clearSelection()"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm">
                            Clear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Policies Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="policy-table w-full">
                    <thead>
                        <tr>
                            <th class="w-12">
                                <input type="checkbox" id="selectAll" onchange="toggleAll()">
                            </th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Order</th>
                            <th class="w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($policies as $policy)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="policies[{{ $policy->id }}][id]"
                                       value="{{ $policy->id }}"
                                       onchange="updateSelection()">
                            </td>
                            <td>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $policy->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $policy->key }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="category-badge category-{{ $policy->category }}">
                                    {{ ucfirst($policy->category) }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge {{ $policy->status ? 'status-active' : 'status-inactive' }}">
                                    {{ $policy->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-sm text-gray-600">
                                {{ $policy->updated_at->format('M d, Y') }}
                            </td>
                            <td>
                                <input type="number"
                                       name="policies[{{ $policy->id }}][order]"
                                       value="{{ $policy->order ?? '' }}"
                                       class="w-16 px-2 py-1 border border-gray-300 rounded text-sm"
                                       min="1">
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('dashboard.policies.edit', $policy) }}"
                                       class="action-btn btn-edit">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('dashboard.policies.destroy', $policy) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this policy?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500">
                                @if($search || $category)
                                    No policies found matching your criteria.
                                    <a href="{{ route('dashboard.policies') }}" class="text-blue-600 hover:text-blue-800">
                                        Clear filters
                                    </a>
                                @else
                                    No policies have been created yet.
                                    <a href="{{ route('dashboard.policies.create') }}" class="text-blue-600 hover:text-blue-800">
                                        Create your first policy
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bulk Update Hidden Fields -->
            <input type="hidden" name="bulk_status" id="bulkStatus">
            <input type="hidden" name="bulk_value" id="bulkValue">
        </form>

        <!-- Pagination -->
        @if($policies->hasPages())
        <div class="pagination-links">
            {{ $policies->links() }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function toggleAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('input[name*="policies"][type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });

    updateSelection();
}

function updateSelection() {
    const checkboxes = document.querySelectorAll('input[name*="policies"][type="checkbox"]:checked');
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');

    if (checkboxes.length > 0) {
        bulkActions.classList.remove('hidden');
        selectedCount.textContent = checkboxes.length + ' policies selected';
    } else {
        bulkActions.classList.add('hidden');
    }
}

function bulkUpdate(action, value) {
    document.getElementById('bulkStatus').value = action;
    document.getElementById('bulkValue').value = value;
    document.getElementById('bulkForm').submit();
}

function clearSelection() {
    const checkboxes = document.querySelectorAll('input[name*="policies"][type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateSelection();
}

// Auto-submit on order change
document.addEventListener('change', function(e) {
    if (e.target.name && e.target.name.includes('[order]')) {
        // Optional: Auto-save order changes
        console.log('Order changed for policy', e.target.name);
    }
});
</script>
@endpush
@endsection
