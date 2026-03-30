<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ServicesPageSetting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    public static function get(string $key, $default = null)
    {
        return Cache::remember("services_page_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }
            
            if ($setting->type === 'json') {
                return json_decode($setting->value, true);
            }
            
            return $setting->value;
        });
    }

    public static function set(string $key, $value, string $type = 'text'): void
    {
        if ($type === 'json' && is_array($value)) {
            $value = json_encode($value);
        }

        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );

        Cache::forget("services_page_setting_{$key}");
    }

    public static function getAllSettings(): array
    {
        return Cache::remember('services_page_all_settings', 3600, function () {
            $settings = [];
            foreach (static::all() as $setting) {
                $settings[$setting->key] = $setting->type === 'json' 
                    ? json_decode($setting->value, true) 
                    : $setting->value;
            }
            return $settings;
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('services_page_all_settings');
        foreach (static::pluck('key') as $key) {
            Cache::forget("services_page_setting_{$key}");
        }
    }
}
