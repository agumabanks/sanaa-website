<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Policy extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'category',
        'order',
        'last_updated_by'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('title');
    }

    // Accessors
    public function getSlugAttribute()
    {
        return Str::slug($this->key);
    }

    public function getUrlAttribute()
    {
        return route('policies.show', $this->key);
    }

    public function getFormattedDateAttribute()
    {
        return $this->updated_at->format('M d, Y');
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        return Str::limit(strip_tags($this->content), 160);
    }

    // Helper methods
    public static function getCategories()
    {
        return [
            'legal' => 'Legal & Compliance',
            'privacy' => 'Privacy & Security',
            'licenses' => 'Licenses & Certifications',
            'corporate' => 'Corporate Information'
        ];
    }

    public static function getPolicyKeys()
    {
        return [
            // Legal & Compliance
            'terms' => ['title' => 'Terms & Conditions', 'category' => 'legal'],
            'seller-policies' => ['title' => 'Seller Policies', 'category' => 'legal'],

            // Privacy & Security
            'privacy-notice' => ['title' => 'Privacy Notice', 'category' => 'privacy'],
            'security' => ['title' => 'Security', 'category' => 'privacy'],
            'consumer-health-privacy' => ['title' => 'Consumer Health Privacy', 'category' => 'privacy'],

            // Licenses & Certifications
            'government-licenses' => ['title' => 'Government Licenses', 'category' => 'licenses'],
            'sanaa-brands-licenses' => ['title' => 'Sanaa Brands Licenses', 'category' => 'licenses'],
            'sanaa-finance-licenses' => ['title' => 'Sanaa Finance Licenses', 'category' => 'licenses'],
            'hardware-compliance-certifications' => ['title' => 'Hardware Compliance Certifications', 'category' => 'licenses'],

            // Corporate Information
            'open-corporates' => ['title' => 'Open Corporates', 'category' => 'corporate']
        ];
    }

    public static function ensureAllPoliciesExist()
    {
        $policyKeys = self::getPolicyKeys();

        foreach ($policyKeys as $key => $data) {
            self::firstOrCreate(
                ['key' => $key],
                [
                    'title' => $data['title'],
                    'category' => $data['category'],
                    'content' => '<p>Content for ' . $data['title'] . ' will be added soon.</p>',
                    'status' => true,
                    'order' => array_search($key, array_keys($policyKeys)) + 1
                ]
            );
        }
    }
}
