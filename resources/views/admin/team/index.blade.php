<x-admin-dashboard-layout title="Team">
    <x-slot name="header">Team Management</x-slot>

    <style>
        .photo-mode-toggle {
            display: flex;
            gap: 16px;
            margin-bottom: 12px;
        }
        .photo-mode-toggle label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #1d1d1f;
            cursor: pointer;
        }
        .photo-mode-toggle input[type="radio"] {
            accent-color: #0071e3;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
            gap: 8px;
            max-height: 240px;
            overflow-y: auto;
            padding: 4px;
            background: #f5f5f7;
            border-radius: 8px;
        }
        .image-grid-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .image-grid-item:hover {
            border-color: #86868b;
        }
        .image-grid-item.selected {
            border-color: #0071e3;
            box-shadow: 0 0 0 2px rgba(0,113,227,0.3);
        }
        .image-grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-grid-item .check {
            position: absolute;
            top: 3px;
            right: 3px;
            width: 18px;
            height: 18px;
            background: #0071e3;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .image-grid-item.selected .check {
            display: flex;
        }
        .image-grid-empty {
            grid-column: 1 / -1;
            padding: 20px;
            text-align: center;
            color: #86868b;
            font-size: 12px;
        }
    </style>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Manage team members displayed on your website</p>
            </div>
            <button onclick="document.getElementById('create-member-modal').classList.remove('hidden')" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Member
            </button>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $members->count() }}</p>
                        <p class="text-sm text-gray-500">Team Members</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $members->pluck('title')->unique()->filter()->count() }}</p>
                        <p class="text-sm text-gray-500">Roles</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $members->whereNotNull('photo')->count() }}</p>
                        <p class="text-sm text-gray-500">With Photos</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="content-card p-4">
            <div class="relative">
                <input type="text" id="member-search" placeholder="Search team members..." class="input-field pl-10">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Team Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="team-grid">
            @forelse($members as $member)
                <div class="content-card overflow-hidden group member-item" data-name="{{ strtolower($member->name) }}">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" class="w-16 h-16 rounded-2xl object-cover" alt="{{ $member->name }}">
                            @else
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xl font-semibold">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $member->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $member->title ?? 'Team Member' }}</p>
                            </div>
                        </div>
                        
                        @if($member->bio)
                            <p class="text-sm text-gray-600 mt-4 line-clamp-2">{{ Str::limit($member->bio, 100) }}</p>
                        @endif

                        <div class="flex items-center gap-2 mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('dashboard.team.edit', $member) }}" class="flex-1 btn-secondary text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('dashboard.team.destroy', $member) }}" onsubmit="return confirm('Delete this team member?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 rounded-lg hover:bg-red-50 text-gray-500 hover:text-red-600 apple-transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="content-card p-12 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">No team members yet</h3>
                        <p class="text-gray-500 mt-1">Add your first team member</p>
                        <button onclick="document.getElementById('create-member-modal').classList.remove('hidden')" class="btn-primary mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Member
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Member Modal -->
    <div id="create-member-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('create-member-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg my-8" onclick="event.stopPropagation()" style="box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Add Team Member</h3>
                    <p class="text-sm text-gray-500 mt-1">Add a new member to your team</p>
                </div>
                <form method="POST" action="{{ route('dashboard.team.store') }}" enctype="multipart/form-data" class="p-6 space-y-5" style="max-height: 70vh; overflow-y: auto;">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="name" required class="input-field" placeholder="John Doe">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title / Role</label>
                            <input type="text" name="title" class="input-field" placeholder="CEO, Designer, Developer...">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="3" class="input-field" placeholder="Brief biography..." style="min-height: 80px;"></textarea>
                    </div>
                    
                    <!-- Photo Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                        
                        <div class="photo-mode-toggle">
                            <label>
                                <input type="radio" name="photo_mode" value="upload" checked onchange="togglePhotoMode('upload')">
                                Upload new
                            </label>
                            <label>
                                <input type="radio" name="photo_mode" value="existing" onchange="togglePhotoMode('existing')">
                                Choose from library
                            </label>
                        </div>
                        
                        <!-- Upload Section -->
                        <div id="create-upload-section">
                            <input type="file" name="photo" accept="image/*" class="input-field" style="padding: 8px;">
                        </div>
                        
                        <!-- Existing Images Section -->
                        <input type="hidden" name="photo_existing" id="create_photo_existing">
                        <div id="create-existing-section" style="display: none;">
                            @if(isset($availableImages) && $availableImages->count())
                                <div class="image-grid">
                                    @foreach($availableImages->take(50) as $img)
                                        <div class="image-grid-item" data-path="{{ $img['path'] }}" onclick="selectCreateImage(this)">
                                            <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                            <div class="check">
                                                <svg width="10" height="10" fill="none" stroke="#fff" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p style="font-size: 11px; color: #86868b; margin-top: 6px;">Click to select</p>
                            @else
                                <div class="image-grid">
                                    <div class="image-grid-empty">
                                        No images in storage yet.<br>
                                        Upload one instead.
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="document.getElementById('create-member-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Add Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Search filter
        const searchInput = document.getElementById('member-search');
        const teamGrid = document.getElementById('team-grid');

        searchInput?.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            teamGrid?.querySelectorAll('.member-item').forEach(item => {
                const name = item.dataset.name || '';
                item.style.display = name.includes(searchTerm) ? '' : 'none';
            });
        });

        // Toggle photo mode in create modal
        function togglePhotoMode(mode) {
            const uploadSection = document.getElementById('create-upload-section');
            const existingSection = document.getElementById('create-existing-section');
            
            if (mode === 'upload') {
                uploadSection.style.display = 'block';
                existingSection.style.display = 'none';
            } else {
                uploadSection.style.display = 'none';
                existingSection.style.display = 'block';
            }
        }
        
        // Select image from grid in create modal
        function selectCreateImage(element) {
            document.querySelectorAll('#create-existing-section .image-grid-item').forEach(item => {
                item.classList.remove('selected');
            });
            element.classList.add('selected');
            document.getElementById('create_photo_existing').value = element.dataset.path;
        }
    </script>
    @endpush
</x-admin-dashboard-layout>
