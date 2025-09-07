<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $includeBody = filter_var($request->query('full'), FILTER_VALIDATE_BOOL) || str_contains((string) $request->query('fields', ''), 'body');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'body' => $this->when($includeBody, $this->body),
            'reading_time' => $this->reading_time,
            'featured' => (bool) $this->featured,
            'status' => $this->status,
            'published_at' => optional($this->published_at)->toISOString(),
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),
            'url' => $this->url,
            'featured_image_url' => $this->featured_image_url,
            'stats' => [
                'views' => (int) $this->views,
                'likes' => (int) $this->likes,
                'shares' => (int) $this->shares,
                'bookmarks' => (int) $this->bookmarks,
                'saves' => (int) $this->saves,
            ],
            'author' => $this->whenLoaded('author', function () {
                return [
                    'id' => $this->author->id,
                    'name' => $this->author->name,
                ];
            }),
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                    'slug' => $this->category->slug,
                    'url' => route('blog.category', $this->category->slug),
                ];
            }),
            'tags' => $this->whenLoaded('tags', function () {
                return $this->tags->map(function ($tag) {
                    return [
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'slug' => $tag->slug,
                    ];
                })->values();
            }),
        ];
    }
}

