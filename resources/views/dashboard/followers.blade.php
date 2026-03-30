<x-dashboard-layout title="Followers & Following">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            Network
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div x-data="{ activeTab: 'followers' }" class="space-y-6">
                <!-- Data Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button @click="activeTab = 'followers'" 
                            :class="{ 'border-emerald-500 text-emerald-600': activeTab === 'followers', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'followers' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Followers
                            <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-gray-100 text-gray-900">{{ $followers->total() }}</span>
                        </button>
                        <button @click="activeTab = 'following'"
                            :class="{ 'border-emerald-500 text-emerald-600': activeTab === 'following', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'following' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Following
                            <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-gray-100 text-gray-900">{{ $following->total() }}</span>
                        </button>
                    </nav>
                </div>

                <!-- Followers Tab -->
                <div x-show="activeTab === 'followers'" class="space-y-6">
                    @forelse($followers as $follower)
                        <div class="bg-white rounded-xl border border-gray-200 p-6 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $follower->profile_photo_url }}" alt="{{ $follower->name }}">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $follower->name }}</h3>
                                    <p class="text-xs text-gray-500">{{ $follower->blogs_count }} stories published</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Remove
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-gray-200 border-dashed">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No followers yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Keep writing great stories and they will come!</p>
                        </div>
                    @endforelse
                    
                    {{ $followers->links() }}
                </div>

                <!-- Following Tab -->
                <div x-show="activeTab === 'following'" class="space-y-6" style="display: none;">
                    @forelse($following as $followed)
                        <div class="bg-white rounded-xl border border-gray-200 p-6 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $followed->profile_photo_url }}" alt="{{ $followed->name }}">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $followed->name }}</h3>
                                    <p class="text-xs text-gray-500">{{ $followed->blogs_count }} stories published</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">
                                Following
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-gray-200 border-dashed">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Not following anyone</h3>
                            <p class="mt-1 text-sm text-gray-500">Discover amazing authors and follow them!</p>
                            <div class="mt-6">
                                <a href="{{ route('blog.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    Explore Stories
                                </a>
                            </div>
                        </div>
                    @endforelse

                    {{ $following->links() }}
                </div>

            </div>
        </div>
    </div>
</x-dashboard-layout>
