<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainSetting extends Model
{
    use HasFactory;

    protected $table = 'domain_settings';

    protected $fillable = [
        'key',
        'domain',
        'is_active',
        'last_updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active domain for a given key
     */
    public static function getActiveDomain(string $key): ?string
    {
        return static::where('key', $key)
            ->where('is_active', true)
            ->value('domain');
    }

    /**
     * Get all domain settings
     */
    public static function getAllSettings(): array
    {
        return static::all()->pluck('domain', 'key')->toArray();
    }

    /**
     * Relationship with the user who last updated this setting
     */
    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'last_updated_by');
    }
}