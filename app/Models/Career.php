<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Career extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'department',
        'location',
        'job_type',
        'salary_range',
        'requirements',
        'responsibilities',
        'benefits',
        'status',
        'published_at',
        'closes_at',
        'meta_title',
        'meta_description',
        'created_by',
        'view_count',
        'application_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'closes_at' => 'datetime',
        'view_count' => 'integer',
        'application_count' => 'integer',
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_CLOSED = 'closed';

    const TYPE_FULL_TIME = 'full-time';
    const TYPE_PART_TIME = 'part-time';
    const TYPE_CONTRACT = 'contract';
    const TYPE_INTERNSHIP = 'internship';
    const TYPE_REMOTE = 'remote';

    public static function statuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    public static function jobTypes(): array
    {
        return [
            self::TYPE_FULL_TIME => 'Full Time',
            self::TYPE_PART_TIME => 'Part Time',
            self::TYPE_CONTRACT => 'Contract',
            self::TYPE_INTERNSHIP => 'Internship',
            self::TYPE_REMOTE => 'Remote',
        ];
    }

    public static function departments(): array
    {
        return [
            'engineering' => 'Engineering',
            'product' => 'Product',
            'design' => 'Design',
            'marketing' => 'Marketing',
            'sales' => 'Sales',
            'customer-success' => 'Customer Success',
            'operations' => 'Operations',
            'finance' => 'Finance',
            'hr' => 'Human Resources',
            'legal' => 'Legal',
            'other' => 'Other',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->title);

                // Ensure unique slug
                $count = static::where('slug', 'like', $career->slug . '%')->count();
                if ($count > 0) {
                    $career->slug = $career->slug . '-' . ($count + 1);
                }
            }
        });

        static::updating(function ($career) {
            if ($career->isDirty('title') && !$career->isDirty('slug')) {
                $career->slug = Str::slug($career->title);

                $count = static::where('slug', 'like', $career->slug . '%')
                    ->where('id', '!=', $career->id)
                    ->count();
                if ($count > 0) {
                    $career->slug = $career->slug . '-' . ($count + 1);
                }
            }
        });
    }

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    // Accessors
    public function getJobTypeLabelAttribute(): string
    {
        return self::jobTypes()[$this->job_type] ?? $this->job_type;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function getDepartmentLabelAttribute(): string
    {
        return self::departments()[$this->department] ?? ucfirst($this->department ?? 'Other');
    }

    public function getIsActiveAttribute(): bool
    {
        if ($this->status !== self::STATUS_PUBLISHED) {
            return false;
        }

        if ($this->closes_at && $this->closes_at->isPast()) {
            return false;
        }

        return true;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT => 'yellow',
            self::STATUS_PUBLISHED => 'green',
            self::STATUS_CLOSED => 'gray',
            default => 'gray',
        };
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSED);
    }

    public function scopeActive($query)
    {
        return $query->published()
            ->where(function ($q) {
                $q->whereNull('closes_at')
                    ->orWhere('closes_at', '>', now());
            });
    }

    public function scopeByDepartment($query, string $department)
    {
        return $query->where('department', $department);
    }

    public function scopeByLocation($query, string $location)
    {
        return $query->where('location', $location);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('job_type', $type);
    }

    public function scopeSearch($query, ?string $term)
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%")
                ->orWhere('department', 'like', "%{$term}%")
                ->orWhere('location', 'like', "%{$term}%");
        });
    }

    // Methods
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    public function updateApplicationCount(): void
    {
        $this->update([
            'application_count' => $this->applications()->count()
        ]);
    }

    public function publish(): void
    {
        $this->update([
            'status' => self::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);
    }

    public function close(): void
    {
        $this->update([
            'status' => self::STATUS_CLOSED,
        ]);
    }

    public function reopen(): void
    {
        $this->update([
            'status' => self::STATUS_PUBLISHED,
            'closes_at' => null,
        ]);
    }
}
