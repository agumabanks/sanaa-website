<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Create Blog Post</h3>
                <form method="POST" action="{{ route('dashboard.blog.store') }}" class="mb-8" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-label for="title" value="Title" />
                        <x-input id="title" name="title" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="excerpt" value="Excerpt" />
                        <textarea id="excerpt" name="excerpt" class="w-full rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-label for="body" value="Body" />
                        <textarea id="body" name="body" class="w-full rounded" rows="5"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-label for="image" value="Image" />
                        <input type="file" name="image" id="image">
                    </div>
                    <x-button>Create</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4">Create Business Category</h3>
                <form method="POST" action="{{ route('dashboard.category.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="name" value="Name" />
                        <x-input id="name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="description" value="Description" />
                        <textarea id="description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
