<x-dashboard-layout title="Blog">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog
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

                @php($posts = \App\Models\Blog::orderByDesc('created_at')->get())
                @if($posts->count())
                    <h3 class="text-lg font-semibold mb-4">Manage Posts</h3>
                    <div class="space-y-6">
                        @foreach($posts as $post)
                            <div class="border p-4 rounded">
                                <form method="POST" action="{{ route('dashboard.blog.update', $post) }}" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <x-label for="title-{{ $post->id }}" value="Title" />
                                        <x-input id="title-{{ $post->id }}" name="title" class="w-full" value="{{ $post->title }}" />
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="excerpt-{{ $post->id }}" value="Excerpt" />
                                        <textarea id="excerpt-{{ $post->id }}" name="excerpt" class="w-full rounded">{{ $post->excerpt }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="body-{{ $post->id }}" value="Body" />
                                        <textarea id="body-{{ $post->id }}" name="body" class="w-full rounded" rows="5">{{ $post->body }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="image-{{ $post->id }}" value="Image" />
                                        <input type="file" name="image" id="image-{{ $post->id }}">
                                    </div>
                                    <x-button>Update</x-button>
                                </form>
                                <form method="POST" action="{{ route('dashboard.blog.destroy', $post) }}" class="mt-2">
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
