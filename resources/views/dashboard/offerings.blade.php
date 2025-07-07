<x-dashboard-layout title="Offerings">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products & Services
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Add Offering</h3>
                <form method="POST" action="{{ route('dashboard.offering.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-label for="offering-title" value="Title" />
                        <x-input id="offering-title" name="title" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="offering-type" value="Type" />
                        <select id="offering-type" name="type" class="w-full rounded">
                            <option value="product">Product</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="offering-description" value="Description" />
                        <textarea id="offering-description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-label for="offering-link" value="Link" />
                        <x-input id="offering-link" name="link" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="offering-image" value="Image" />
                        <input type="file" name="image" id="offering-image">
                    </div>
                    <x-button>Create</x-button>
                </form>

                @if(isset($items) && $items->count())
                    <h3 class="text-lg font-semibold mb-4 mt-8">Manage Offerings</h3>
                    <div class="space-y-6">
                        @foreach($items as $offering)
                            <div class="border p-4 rounded">
                                <form method="POST" action="{{ route('dashboard.offering.update', $offering) }}" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <x-label for="title-{{ $offering->id }}" value="Title" />
                                        <x-input id="title-{{ $offering->id }}" name="title" class="w-full" value="{{ $offering->title }}" />
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="type-{{ $offering->id }}" value="Type" />
                                        <select id="type-{{ $offering->id }}" name="type" class="w-full rounded">
                                            <option value="product" @if($offering->type=='product') selected @endif>Product</option>
                                            <option value="service" @if($offering->type=='service') selected @endif>Service</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="description-{{ $offering->id }}" value="Description" />
                                        <textarea id="description-{{ $offering->id }}" name="description" class="w-full rounded">{{ $offering->description }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="link-{{ $offering->id }}" value="Link" />
                                        <x-input id="link-{{ $offering->id }}" name="link" class="w-full" value="{{ $offering->link }}" />
                                    </div>
                                    <div class="mb-4">
                                        <x-label for="image-{{ $offering->id }}" value="Image" />
                                        <input type="file" name="image" id="image-{{ $offering->id }}">
                                    </div>
                                    <x-button>Update</x-button>
                                </form>
                                <form method="POST" action="{{ route('dashboard.offering.destroy', $offering) }}" class="mt-2">
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
