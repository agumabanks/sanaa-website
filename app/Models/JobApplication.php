<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    protected $fillable = [
        'career_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'location',
        'linkedin_url',
        'portfolio_url',
        'cover_letter',
        'resume_path',
        'additional_documents',
        'screening_answers',
        'status',
        'notes',
        'reviewed_by',
        'reviewed_at',
        'source',
        'referral_code',
    ];

    protected $casts = [
        'additional_documents' => 'array',
        'screening_answers' => 'array',
        'reviewed_at' => 'datetime',
    ];

    const STATUS_NEW = 'new';
    const STATUS_REVIEWING = 'reviewing';
    const STATUS_SCREENING = 'screening';
    const STATUS_INTERVIEW = 'interview';
    const STATUS_OFFER = 'offer';
    const STATUS_HIRED = 'hired';
    const STATUS_REJECTED = 'rejected';
    const STATUS_WITHDRAWN = 'withdrawn';

    public static function statuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_REVIEWING => 'Under Review',
            self::STATUS_SCREENING => 'Screening',
            self::STATUS_INTERVIEW => 'Interview',
            self::STATUS_OFFER => 'Offer Extended',
            self::STATUS_HIRED => 'Hired',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_WITHDRAWN => 'Withdrawn',
        ];
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'blue',
            self::STATUS_REVIEWING => 'yellow',
            self::STATUS_SCREENING => 'purple',
            self::STATUS_INTERVIEW => 'indigo',
            self::STATUS_OFFER => 'emerald',
            self::STATUS_HIRED => 'green',
            self::STATUS_REJECTED => 'red',
            self::STATUS_WITHDRAWN => 'gray',
            default => 'gray',
        };
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [self::STATUS_REJECTED, self::STATUS_WITHDRAWN, self::STATUS_HIRED]);
    }

    public function scopeRecent($query)
    {
        return $query->orderByDesc('created_at');
    }
}
