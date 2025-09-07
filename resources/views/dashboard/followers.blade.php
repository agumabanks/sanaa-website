<x-dashboard-layout title="Followers">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Followers</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if($followers->count() === 0)
                <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center text-gray-600">No followers yet.</div>
            @else
                <div class="bg-white rounded-2xl border border-gray-200 divide-y">
                    @foreach($followers as $u)
                        <div class="p-4 flex items-center gap-3">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ $u->profile_photo_url }}" alt="{{ $u->name }}" />
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-gray-900 truncate">{{ $u->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ $u->email }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pt-4">{{ $followers->links() }}</div>
            @endif
        </div>
    </div>
</x-dashboard-layout>

