<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SitePage extends Model
{
    use HasFactory;

    protected $table = 'site_pages';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'blocks',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
        'canonical_url',
        'og_image',
        'schema_type',
        'is_indexed',
        'status',
        'template',
        'published_at',
        'scheduled_at',
        'created_by',
        'last_updated_by',
        'show_header',
        'show_footer',
        'custom_css',
    ];

    protected $casts = [
        'status' => 'boolean',
        'blocks' => 'array',
        'is_indexed' => 'boolean',
        'show_header' => 'boolean',
        'show_footer' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    const TEMPLATE_DEFAULT = 'default';
    const TEMPLATE_FULL_WIDTH = 'full-width';
    const TEMPLATE_LANDING = 'landing';
    const TEMPLATE_SIDEBAR = 'sidebar';

    public static function templates(): array
    {
        return [
            self::TEMPLATE_DEFAULT => 'Default',
            self::TEMPLATE_FULL_WIDTH => 'Full Width',
            self::TEMPLATE_LANDING => 'Landing Page',
            self::TEMPLATE_SIDEBAR => 'With Sidebar',
        ];
    }

    public static function blockTypes(): array
    {
        return [
            'hero' => [
                'name' => 'Hero Section',
                'icon' => 'layout',
                'description' => 'Large hero section with title, subtitle, and CTA',
            ],
            'richtext' => [
                'name' => 'Rich Text',
                'icon' => 'file-text',
                'description' => 'Rich text content with formatting',
            ],
            'features' => [
                'name' => 'Features Grid',
                'icon' => 'grid',
                'description' => 'Feature cards in a grid layout',
            ],
            'cta' => [
                'name' => 'Call to Action',
                'icon' => 'mouse-pointer',
                'description' => 'Prominent call-to-action section',
            ],
            'image' => [
                'name' => 'Image',
                'icon' => 'image',
                'description' => 'Single image with caption',
            ],
            'gallery' => [
                'name' => 'Gallery',
                'icon' => 'images',
                'description' => 'Image gallery grid',
            ],
            'video' => [
                'name' => 'Video',
                'icon' => 'video',
                'description' => 'Embedded video (YouTube, Vimeo)',
            ],
            'testimonials' => [
                'name' => 'Testimonials',
                'icon' => 'message-circle',
                'description' => 'Customer testimonial carousel',
            ],
            'faq' => [
                'name' => 'FAQ',
                'icon' => 'help-circle',
                'description' => 'Frequently asked questions accordion',
            ],
            'contact' => [
                'name' => 'Contact Form',
                'icon' => 'mail',
                'description' => 'Embedded contact form',
            ],
            'custom_html' => [
                'name' => 'Custom HTML',
                'icon' => 'code',
                'description' => 'Raw HTML content',
            ],
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);

                $count = static::where('slug', 'like', $page->slug . '%')->count();
                if ($count > 0) {
                    $page->slug = $page->slug . '-' . ($count + 1);
                }
            }

            if ($page->status && empty($page->published_at)) {
                $page->published_at = now();
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('status') && $page->status && empty($page->published_at)) {
                $page->published_at = now();
            }
        });
    }

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    // Accessors
    public function getIsPublishedAttribute(): bool
    {
        return $this->status && ($this->published_at === null || $this->published_at->isPast());
    }

    public function getIsScheduledAttribute(): bool
    {
        return $this->status && $this->scheduled_at !== null && $this->scheduled_at->isFuture();
    }

    public function getHasBlocksAttribute(): bool
    {
        return !empty($this->blocks) && is_array($this->blocks);
    }

    public function getBlockCountAttribute(): int
    {
        return $this->has_blocks ? count($this->blocks) : 0;
    }

    // Block helpers
    public function getBlocks(): array
    {
        return $this->blocks ?? [];
    }

    public function addBlock(string $type, array $data = [], ?int $position = null): self
    {
        $blocks = $this->blocks ?? [];

        $block = [
            'id' => Str::uuid()->toString(),
            'type' => $type,
            'data' => $data,
        ];

        if ($position !== null && $position < count($blocks)) {
            array_splice($blocks, $position, 0, [$block]);
        } else {
            $blocks[] = $block;
        }

        $this->blocks = $blocks;

        return $this;
    }

    public function updateBlock(string $blockId, array $data): self
    {
        $blocks = $this->blocks ?? [];

        foreach ($blocks as $index => $block) {
            if ($block['id'] === $blockId) {
                $blocks[$index]['data'] = array_merge($block['data'] ?? [], $data);
                break;
            }
        }

        $this->blocks = $blocks;

        return $this;
    }

    public function removeBlock(string $blockId): self
    {
        $blocks = array_filter($this->blocks ?? [], fn($block) => $block['id'] !== $blockId);
        $this->blocks = array_values($blocks);

        return $this;
    }

    public function reorderBlocks(array $blockIds): self
    {
        $blocksById = collect($this->blocks ?? [])->keyBy('id');
        $reordered = [];

        foreach ($blockIds as $id) {
            if ($blocksById->has($id)) {
                $reordered[] = $blocksById->get($id);
            }
        }

        $this->blocks = $reordered;

        return $this;
    }

    public function getBlockById(string $blockId): ?array
    {
        foreach ($this->blocks ?? [] as $block) {
            if ($block['id'] === $blockId) {
                return $block;
            }
        }

        return null;
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeDraft($query)
    {
        return $query->where('status', false);
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', true)
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now());
    }

    public function scopeByTemplate($query, string $template)
    {
        return $query->where('template', $template);
    }

    // Methods
    public function publish(): void
    {
        $this->update([
            'status' => true,
            'published_at' => now(),
            'scheduled_at' => null,
        ]);
    }

    public function unpublish(): void
    {
        $this->update([
            'status' => false,
        ]);
    }

    public function schedule(\DateTimeInterface $date): void
    {
        $this->update([
            'status' => true,
            'scheduled_at' => $date,
        ]);
    }

    public function duplicate(): self
    {
        $clone = $this->replicate();
        $clone->title = $this->title . ' (Copy)';
        $clone->slug = null; // Will be auto-generated
        $clone->status = false;
        $clone->published_at = null;
        $clone->scheduled_at = null;
        $clone->save();

        return $clone;
    }
}
