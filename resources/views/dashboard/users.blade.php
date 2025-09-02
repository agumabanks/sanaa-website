<x-dashboard-layout title="Users">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Users</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if(session('status'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3">
                    {{ session('status') }}
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

            <!-- Create user -->
            <form method="POST" action="{{ route('dashboard.users.store') }}" class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                @csrf
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Create User</h3>
                    <p class="text-sm text-gray-500 mt-1">Add a new user to the system.</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text" required class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" required class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input id="password" name="password" type="password" required class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>
                        <div class="flex items-center gap-3 pt-7">
                            <input id="is_admin" name="is_admin" type="checkbox" value="1" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                            <label for="is_admin" class="text-sm text-gray-700">Administrator</label>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-2xl">
                    <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Create</button>
                </div>
            </form>

            <!-- Manage users -->
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Manage Users</h3>
                <p class="text-sm text-gray-500">{{ $users->count() }} total</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($users as $u)
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                        <form method="POST" action="{{ route('dashboard.users.update', $u) }}" class="space-y-5">
                            @csrf
                            @method('PUT')
                            <div class="flex items-start gap-4">
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $u->profile_photo_url }}" alt="{{ $u->name }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1">
                                    <div>
                                        <label for="name-{{ $u->id }}" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input id="name-{{ $u->id }}" name="name" type="text" value="{{ $u->name }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                    </div>
                                    <div>
                                        <label for="email-{{ $u->id }}" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input id="email-{{ $u->id }}" name="email" type="email" value="{{ $u->email }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                    </div>
                                    <div>
                                        <label for="password-{{ $u->id }}" class="block text-sm font-medium text-gray-700">Password (optional)</label>
                                        <input id="password-{{ $u->id }}" name="password" type="password" placeholder="Leave blank to keep" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                    </div>
                                    <div class="flex items-center gap-3 pt-7">
                                        <input id="is_admin-{{ $u->id }}" name="is_admin" type="checkbox" value="1" @checked($u->is_admin) class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                                        <label for="is_admin-{{ $u->id }}" class="text-sm text-gray-700">Administrator</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-3">
                                <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Update</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('dashboard.users.destroy', $u) }}" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" @if(auth()->id() === $u->id) disabled @endif class="inline-flex items-center rounded-lg bg-red-600 text-white px-3 py-2 text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 disabled:opacity-50">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-dashboard-layout>

