<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Team
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Add Team Member</h3>
                <form method="POST" action="{{ route('dashboard.team.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-label for="team-name" value="Name" />
                        <x-input id="team-name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="team-title" value="Title" />
                        <x-input id="team-title" name="title" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="team-bio" value="Bio" />
                        <textarea id="team-bio" name="bio" class="w-full rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-label for="team-photo" value="Photo" />
                        <input type="file" name="photo" id="team-photo">
                    </div>
                    <x-button>Add Member</x-button>
                </form>

                @if(isset($teamMembers) && $teamMembers->count())
                <h3 class="text-lg font-semibold mb-4 mt-8">Manage Team Members</h3>
                <div class="space-y-6">
                    @foreach($teamMembers as $member)
                        <div class="border p-4 rounded">
                            <form method="POST" action="{{ route('dashboard.team.update', $member) }}" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center space-x-4">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/'.$member->photo) }}" class="w-16 h-16 rounded-full object-cover" alt="{{ $member->name }}">
                                    @endif
                                    <div class="flex-1">
                                        <x-label for="name-{{ $member->id }}" value="Name" />
                                        <x-input id="name-{{ $member->id }}" name="name" class="w-full" value="{{ $member->name }}" />
                                    </div>
                                    <div class="flex-1">
                                        <x-label for="title-{{ $member->id }}" value="Title" />
                                        <x-input id="title-{{ $member->id }}" name="title" class="w-full" value="{{ $member->title }}" />
                                    </div>
                                </div>
                                <div>
                                    <x-label for="bio-{{ $member->id }}" value="Bio" />
                                    <textarea id="bio-{{ $member->id }}" name="bio" class="w-full rounded">{{ $member->bio }}</textarea>
                                </div>
                                <div>
                                    <x-label for="photo-{{ $member->id }}" value="Photo" />
                                    <input type="file" name="photo" id="photo-{{ $member->id }}">
                                </div>
                                <div class="flex space-x-2">
                                    <x-button>Update</x-button>
                                    <a href="{{ route('dashboard.team.edit', $member) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:border-gray-600 focus:ring focus:ring-gray-200 active:bg-gray-600 disabled:opacity-25 transition">More</a>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('dashboard.team.destroy', $member) }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 hover:bg-red-600">Delete</x-button>
                            </form>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>
