<x-admin-dashboard-layout title="Edit Team Member">
    <x-slot name="header">Edit Team Member</x-slot>

    <style>
        .edit-form {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
            max-width: 720px;
        }
        .form-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .form-header-photo {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            background: #f5f5f7;
        }
        .form-title {
            font-size: 17px;
            font-weight: 600;
            color: #1d1d1f;
        }
        .form-subtitle {
            font-size: 13px;
            color: #86868b;
        }
        .form-body {
            padding: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #1d1d1f;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            height: 40px;
            padding: 0 12px;
            background: #f5f5f7;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 8px;
            font-size: 14px;
            color: #1d1d1f;
            outline: none;
            transition: all 0.15s ease;
        }
        .form-input:focus {
            background: #fff;
            border-color: #0071e3;
            box-shadow: 0 0 0 3px rgba(0,113,227,0.15);
        }
        .form-textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            background: #f5f5f7;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 8px;
            font-size: 14px;
            color: #1d1d1f;
            outline: none;
            resize: vertical;
            transition: all 0.15s ease;
        }
        .form-textarea:focus {
            background: #fff;
            border-color: #0071e3;
            box-shadow: 0 0 0 3px rgba(0,113,227,0.15);
        }
        
        /* Photo selection */
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
        
        .current-photo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 12px;
            padding: 12px;
            background: #f5f5f7;
            border-radius: 8px;
        }
        .current-photo img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }
        .current-photo-info {
            font-size: 13px;
            color: #86868b;
        }
        
        /* Image grid */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 8px;
            margin-top: 12px;
            max-height: 320px;
            overflow-y: auto;
            padding: 4px;
        }
        .image-grid-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 8px;
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
            top: 4px;
            right: 4px;
            width: 20px;
            height: 20px;
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
            padding: 24px;
            text-align: center;
            color: #86868b;
            font-size: 13px;
        }
        
        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid rgba(0,0,0,0.06);
            margin-top: 24px;
        }
        .btn {
            height: 40px;
            padding: 0 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .btn-primary { background: #0071e3; color: #fff; }
        .btn-primary:hover { background: #0077ed; }
        .btn-secondary { background: #f5f5f7; color: #1d1d1f; }
        .btn-secondary:hover { background: #e8e8ed; }
        .btn-danger { background: #ff3b30; color: #fff; }
        .btn-danger:hover { background: #ff453a; }
        
        .delete-section {
            margin-top: 24px;
            padding: 20px 24px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
            max-width: 720px;
        }
        .delete-section-title {
            font-size: 15px;
            font-weight: 600;
            color: #ff3b30;
            margin-bottom: 8px;
        }
        .delete-section-text {
            font-size: 13px;
            color: #86868b;
            margin-bottom: 16px;
        }
    </style>

    <div class="edit-form">
        <div class="form-header">
            @if($member->photo)
                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="form-header-photo">
            @else
                <div class="form-header-photo" style="display: flex; align-items: center; justify-content: center; color: #86868b; font-size: 20px; font-weight: 600;">
                    {{ strtoupper(substr($member->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h2 class="form-title">{{ $member->name }}</h2>
                <p class="form-subtitle">{{ $member->title ?? 'Team Member' }}</p>
            </div>
        </div>
        <div class="form-body">
            <form method="POST" action="{{ route('dashboard.team.update', $member) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="name">Full Name *</label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $member->name) }}" required>
                    @error('name')
                        <p style="color: #ff3b30; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="title">Title / Role</label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $member->title) }}" placeholder="e.g. CEO, Designer, Developer">
                </div>

                <div class="form-group">
                    <label class="form-label" for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-textarea" placeholder="Brief biography...">{{ old('bio', $member->bio) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Photo</label>
                    
                    <div class="photo-mode-toggle">
                        <label>
                            <input type="radio" name="photo_mode" value="upload" checked>
                            Upload new photo
                        </label>
                        <label>
                            <input type="radio" name="photo_mode" value="existing">
                            Choose from library
                        </label>
                    </div>
                    
                    <!-- Upload Section -->
                    <div id="upload-section">
                        <input type="file" id="photo" name="photo" accept="image/*" class="form-input" style="padding: 8px 12px; height: auto;">
                        @if($member->photo)
                            <div class="current-photo">
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                                <div class="current-photo-info">
                                    Current photo<br>
                                    <small>Upload a new one to replace</small>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Existing Images Section -->
                    <input type="hidden" name="photo_existing" id="photo_existing">
                    <div id="existing-section" style="display: none;">
                        @if(isset($availableImages) && $availableImages->count())
                            <div class="image-grid">
                                @foreach($availableImages as $img)
                                    <div class="image-grid-item" data-path="{{ $img['path'] }}" onclick="selectImage(this)">
                                        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                        <div class="check">
                                            <svg width="12" height="12" fill="none" stroke="#fff" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p style="font-size: 12px; color: #86868b; margin-top: 8px;">Click an image to select it</p>
                        @else
                            <div class="image-grid">
                                <div class="image-grid-empty">
                                    No images found in storage.<br>
                                    Upload images to team/, images/, uploads/, or photos/ directories.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Changes
                    </button>
                    <a href="{{ route('dashboard.team') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <div class="delete-section">
        <h3 class="delete-section-title">Danger Zone</h3>
        <p class="delete-section-text">Once you delete this team member, there is no going back. Please be certain.</p>
        <form method="POST" action="{{ route('dashboard.team.destroy', $member) }}" onsubmit="return confirm('Are you sure you want to delete this team member? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Team Member
            </button>
        </form>
    </div>

    @push('scripts')
    <script>
        // Toggle between upload and existing images
        document.querySelectorAll('input[name="photo_mode"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const uploadSection = document.getElementById('upload-section');
                const existingSection = document.getElementById('existing-section');
                
                if (this.value === 'upload') {
                    uploadSection.style.display = 'block';
                    existingSection.style.display = 'none';
                } else {
                    uploadSection.style.display = 'none';
                    existingSection.style.display = 'block';
                }
            });
        });
        
        // Select image from grid
        function selectImage(element) {
            // Remove selection from all items
            document.querySelectorAll('.image-grid-item').forEach(item => {
                item.classList.remove('selected');
            });
            
            // Select clicked item
            element.classList.add('selected');
            
            // Set hidden input value
            document.getElementById('photo_existing').value = element.dataset.path;
        }
    </script>
    @endpush
</x-admin-dashboard-layout>
