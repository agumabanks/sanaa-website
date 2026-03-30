<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $table = 'footer_settings';

    protected $fillable = [
        'content',
        'status',
        'last_updated_by',
    ];

    protected $casts = [
        'content' => 'array',
        'status' => 'boolean',
    ];
}

