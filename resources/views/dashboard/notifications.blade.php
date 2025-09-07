<x-dashboard-layout title="Notifications">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Notifications</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if(($notifications ?? collect())->count() === 0)
                <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center text-gray-600">You're all caught up.</div>
            @else
                <div class="bg-white rounded-2xl border border-gray-200 divide-y">
                    @foreach($notifications as $n)
                        <div class="p-4">{{ $n }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>

