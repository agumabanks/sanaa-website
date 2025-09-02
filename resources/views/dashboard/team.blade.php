<x-dashboard-layout title="Team">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Team</h2>
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

            <!-- Create member -->
            <form method="POST" action="{{ route('dashboard.team.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                @csrf
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Add Team Member</h3>
                    <p class="text-sm text-gray-500 mt-1">Add a new person to the public team page.</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="team-name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="team-name" name="name" type="text" required placeholder="Jane Doe" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>
                        <div>
                            <label for="team-title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="team-title" name="title" type="text" placeholder="Head of Partnerships" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>
                    </div>
                    <div>
                        <label for="team-bio" class="block text-sm font-medium text-gray-700">Bio</label>
                        <textarea id="team-bio" name="bio" rows="3" placeholder="Short background and focus areas" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3"></textarea>
                    </div>
                    <div>
                        <label for="team-photo" class="block text-sm font-medium text-gray-700">Photo</label>
                        <input id="team-photo" name="photo" type="file" accept="image/*" class="mt-2 block w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-2xl">
                    <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Add Member</button>
                </div>
            </form>

            @if(isset($teamMembers) && $teamMembers->count())
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Manage Team Members</h3>
                    <p class="text-sm text-gray-500">{{ $teamMembers->count() }} total</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($teamMembers as $member)
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                            <form method="POST" action="{{ route('dashboard.team.update', $member) }}" enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                @method('PUT')
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/'.$member->photo) }}" class="w-16 h-16 rounded-full object-cover" alt="{{ $member->name }}">
                                        @else
                                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">NA</div>
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1">
                                        <div>
                                            <label for="name-{{ $member->id }}" class="block text-sm font-medium text-gray-700">Name</label>
                                            <input id="name-{{ $member->id }}" name="name" type="text" value="{{ $member->name }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                        </div>
                                        <div>
                                            <label for="title-{{ $member->id }}" class="block text-sm font-medium text-gray-700">Title</label>
                                            <input id="title-{{ $member->id }}" name="title" type="text" value="{{ $member->title }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="bio-{{ $member->id }}" class="block text-sm font-medium text-gray-700">Bio</label>
                                            <textarea id="bio-{{ $member->id }}" name="bio" rows="3" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ $member->bio }}</textarea>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="photo-{{ $member->id }}" class="block text-sm font-medium text-gray-700">Photo</label>
                                            <input id="photo-{{ $member->id }}" name="photo" type="file" accept="image/*" class="mt-2 block w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('dashboard.team.edit', $member) }}" class="inline-flex items-center rounded-lg bg-gray-700 text-white px-3 py-2 text-sm font-medium hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">More</a>
                                    <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Update</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('dashboard.team.destroy', $member) }}" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center rounded-lg bg-red-600 text-white px-3 py-2 text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
