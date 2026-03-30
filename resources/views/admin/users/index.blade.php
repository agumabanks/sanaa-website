<x-admin-dashboard-layout title="Users">
    <x-slot name="header">User Management</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Manage user accounts and permissions</p>
            </div>
            <button onclick="document.getElementById('create-user-modal').classList.remove('hidden')" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add User
            </button>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->count() }}</p>
                        <p class="text-sm text-gray-500">Total Users</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->where('is_admin', true)->count() }}</p>
                        <p class="text-sm text-gray-500">Administrators</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->where('is_admin', false)->count() }}</p>
                        <p class="text-sm text-gray-500">Regular Users</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->where('created_at', '>=', now()->subDays(30))->count() }}</p>
                        <p class="text-sm text-gray-500">New This Month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="content-card p-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1">
                    <input type="text" id="user-search" placeholder="Search users..." class="input-field pl-10">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select id="role-filter" class="input-field w-full sm:w-48">
                    <option value="">All Roles</option>
                    <option value="admin">Administrators</option>
                    <option value="user">Regular Users</option>
                </select>
            </div>
        </div>

        <!-- Users Table -->
        <div class="content-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="users-list">
                        @foreach($users as $u)
                            <tr class="table-row" data-name="{{ strtolower($u->name) }}" data-email="{{ strtolower($u->email) }}" data-role="{{ $u->is_admin ? 'admin' : 'user' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-10 h-10 rounded-full object-cover" src="{{ $u->profile_photo_url }}" alt="{{ $u->name }}">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $u->name }}</p>
                                            @if($u->id === auth()->id())
                                                <span class="text-xs text-blue-600">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $u->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="badge {{ $u->is_admin ? 'badge-info' : 'badge-gray' }}">
                                        {{ $u->is_admin ? 'Administrator' : 'User' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-sm">{{ $u->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick="editUser({{ $u->id }}, '{{ $u->name }}', '{{ $u->email }}', {{ $u->is_admin ? 'true' : 'false' }})" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700 apple-transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        @if($u->id !== auth()->id())
                                            <form method="POST" action="{{ route('dashboard.users.destroy', $u) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-gray-500 hover:text-red-600 apple-transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div id="create-user-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('create-user-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md apple-shadow-lg" onclick="event.stopPropagation()">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Add New User</h3>
                    <p class="text-sm text-gray-500 mt-1">Create a new user account</p>
                </div>
                <form method="POST" action="{{ route('dashboard.users.store') }}" class="p-6 space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" required class="input-field" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" required class="input-field" placeholder="john@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required class="input-field" placeholder="Enter password">
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="is_admin_create" name="is_admin" value="1" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_admin_create" class="text-sm text-gray-700">Grant administrator privileges</label>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('create-user-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('edit-user-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md apple-shadow-lg" onclick="event.stopPropagation()">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Edit User</h3>
                    <p class="text-sm text-gray-500 mt-1">Update user information</p>
                </div>
                <form id="edit-user-form" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="edit_name" name="name" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="edit_email" name="email" required class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" class="input-field" placeholder="Leave blank to keep current">
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="edit_is_admin" name="is_admin" value="1" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="edit_is_admin" class="text-sm text-gray-700">Administrator privileges</label>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('edit-user-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function editUser(id, name, email, isAdmin) {
            document.getElementById('edit-user-form').action = `/dashboard/users/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_is_admin').checked = isAdmin;
            document.getElementById('edit-user-modal').classList.remove('hidden');
        }

        const searchInput = document.getElementById('user-search');
        const roleFilter = document.getElementById('role-filter');
        const usersList = document.getElementById('users-list');

        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase();
            const roleValue = roleFilter.value;
            
            usersList.querySelectorAll('tr').forEach(row => {
                const name = row.dataset.name || '';
                const email = row.dataset.email || '';
                const role = row.dataset.role || '';
                
                const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                const matchesRole = !roleValue || role === roleValue;
                
                row.style.display = matchesSearch && matchesRole ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', filterUsers);
        roleFilter?.addEventListener('change', filterUsers);
    </script>
    @endpush
</x-admin-dashboard-layout>
