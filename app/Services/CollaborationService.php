<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogVersion;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CollaborationService
{
    public function autoSave(Blog $blog, array $data): array
    {
        $version = $this->getNextVersion($blog->id);

        $this->createVersionSnapshot($blog, $data['content'] ?? [], $version);

        if (!empty($data['pending_operations'])) {
            foreach ((array) $data['pending_operations'] as $op) {
                $this->storeOperation($blog->id, $op);
            }
        }

        // event(new \App\Events\ContentSaved($blog->id, $version, auth()->id()));

        return [
            'success' => true,
            'version' => $version,
            'saved_at' => now(),
        ];
    }

    public function processOperation(Blog $blog, array $data): array
    {
        $operation = $data['operation'];
        $this->storeOperation($blog->id, $operation);

        // event(new \App\Events\OperationApplied($blog->id, $operation));
        return ['status' => 'applied'];
    }

    // ----- internals -----
    private function getNextVersion(int $blogId): int
    {
        return (int) Cache::increment("blog_version_{$blogId}") ?: 1;
    }

    private function createVersionSnapshot(Blog $blog, array $content, int $version): void
    {
        BlogVersion::create([
            'blog_id' => $blog->id,
            'version_number' => $version,
            'title' => $content['title'] ?? $blog->title,
            'body' => $content['body'] ?? $blog->body,
            'created_by' => optional(auth()->user())->id,
            'changes_summary' => 'Auto-save during collaboration',
            'metadata' => ['source' => 'autosave'],
        ]);
    }

    private function storeOperation(int $blogId, array $operation): void
    {
        $key = "operations:{$blogId}:" . now()->timestamp;
        Redis::setex($key, 3600, json_encode($operation));
    }
}

