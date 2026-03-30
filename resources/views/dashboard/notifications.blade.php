<x-dashboard-layout title="Notifications">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                Notifications
            </h2>
            <button class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                Mark all as read
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- Notification Item: Follow -->
                    <div class="p-4 hover:bg-gray-50 transition-colors cursor-pointer">
                        <div class="flex gap-4">
                            <div class="mt-1">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm-1-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/></svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">
                                    <span class="font-semibold">Sarah Connor</span> started following you.
                                </p>
                                <p class="mt-1 text-xs text-gray-500">2 hours ago</p>
                            </div>
                            <div class="h-2 w-2 rounded-full bg-emerald-500 mt-2"></div>
                        </div>
                    </div>

                    <!-- Notification Item: Comment -->
                    <div class="p-4 hover:bg-gray-50 transition-colors cursor-pointer">
                        <div class="flex gap-4">
                            <div class="mt-1">
                                <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/></svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">
                                    <span class="font-semibold">John Doe</span> commented on your story <span class="font-medium">"The Future of AI"</span>
                                </p>
                                <p class="mt-1 text-sm text-gray-600 line-clamp-1">"This is a fascinating perspective! I completely agree with your points about..."</p>
                                <p class="mt-1 text-xs text-gray-500">5 hours ago</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Item: Like -->
                    <div class="p-4 hover:bg-gray-50 transition-colors cursor-pointer bg-gray-50/50">
                        <div class="flex gap-4">
                            <div class="mt-1">
                                <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">
                                    <span class="font-semibold">Alex Smith</span> and <span class="font-semibold">12 others</span> liked your story <span class="font-medium">"Top 10 Coding Tips"</span>
                                </p>
                                <p class="mt-1 text-xs text-gray-500">1 day ago</p>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State (Hidden for preview) -->
                    <!--
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                        <p class="mt-1 text-sm text-gray-500">You're all caught up! Check back later.</p>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
