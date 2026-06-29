<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogEditorMediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_inline_blog_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->postJson(route('dashboard.blog.media'), [
            'image' => UploadedFile::fake()->image('insight-photo.jpg', 1200, 800),
            'alt' => 'Insight photo',
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'alt' => 'Insight photo',
        ]);

        $storedPath = $response->json('path');

        $this->assertNotEmpty($storedPath);
        Storage::disk('public')->assertExists($storedPath);
    }
}

