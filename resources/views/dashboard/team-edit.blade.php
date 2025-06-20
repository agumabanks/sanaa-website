<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Team Member
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('dashboard.team.update', $member) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-label for="name" value="Name" />
                        <x-input id="name" name="name" class="w-full" value="{{ $member->name }}" />
                    </div>
                    <div>
                        <x-label for="title" value="Title" />
                        <x-input id="title" name="title" class="w-full" value="{{ $member->title }}" />
                    </div>
                    <div>
                        <x-label for="bio" value="Bio" />
                        <textarea id="bio" name="bio" class="w-full rounded">{{ $member->bio }}</textarea>
                    </div>
                    <div>
                        <x-label for="photo" value="Photo" />
                        <input type="file" name="photo" id="photo">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" class="w-24 h-24 mt-2 rounded-full object-cover" alt="{{ $member->name }}">
                        @endif
                    </div>
                    <div class="flex space-x-2">
                        <x-button>Save</x-button>
                        <a href="{{ route('dashboard.team') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:border-gray-600 focus:ring focus:ring-gray-200 active:bg-gray-600 disabled:opacity-25 transition">Cancel</a>
                    </div>
                </form>
                <form method="POST" action="{{ route('dashboard.team.destroy', $member) }}" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <x-button class="bg-red-500 hover:bg-red-600">Delete</x-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
