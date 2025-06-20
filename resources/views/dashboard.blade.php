<x-dashboard-layout>
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

                <h3 class="text-lg font-semibold mb-4 mt-8">Add Team Member</h3>
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

                <h3 class="text-lg font-semibold mb-4 mt-8">Add Career</h3>
                <form method="POST" action="{{ route('dashboard.career.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="career-title" value="Title" />
                        <x-input id="career-title" name="title" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="career-description" value="Description" />
                        <textarea id="career-description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Add Partner</h3>
                <form method="POST" action="{{ route('dashboard.partner.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="partner-name" value="Name" />
                        <x-input id="partner-name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="partner-description" value="Description" />
                        <textarea id="partner-description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Add Developer Platform</h3>
                <form method="POST" action="{{ route('dashboard.developer-platform.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="platform-name" value="Name" />
                        <x-input id="platform-name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="platform-description" value="Description" />
                        <textarea id="platform-description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Add Hardware Rental</h3>
                <form method="POST" action="{{ route('dashboard.hardware-rental.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="hardware-name" value="Name" />
                        <x-input id="hardware-name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="hardware-description" value="Description" />
                        <textarea id="hardware-description" name="description" class="w-full rounded"></textarea>
                    </div>
                    <x-button>Create</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Add Price Item</h3>
                <form method="POST" action="{{ route('dashboard.price.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="price-name" value="Name" />
                        <x-input id="price-name" name="name" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="price-value" value="Price" />
                        <x-input id="price-value" name="price" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <x-label for="price-description" value="Description" />
                        <textarea id="price-description" name="description" class="w-full rounded"></textarea>
                    </div>
                <x-button>Create</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Edit Terms &amp; Conditions</h3>
                <form method="POST" action="{{ route('dashboard.policy.update', ['key' => 'terms']) }}">
                    @csrf
                    <div class="mb-4">
                        <textarea id="terms-content" name="content" class="w-full rounded" rows="5">{{ $terms->content ?? '' }}</textarea>
                    </div>
                    <x-button>Save</x-button>
                </form>

                <h3 class="text-lg font-semibold mb-4 mt-8">Edit Seller Policies</h3>
                <form method="POST" action="{{ route('dashboard.policy.update', ['key' => 'seller-policies']) }}">
                    @csrf
                    <div class="mb-4">
                        <textarea id="seller-content" name="content" class="w-full rounded" rows="5">{{ $seller->content ?? '' }}</textarea>
                    </div>
                    <x-button>Save</x-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
