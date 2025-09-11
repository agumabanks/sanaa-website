<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceResource extends Model
{
    protected $fillable = [
        'title','type','file_path','url','tags','is_active'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];
}

