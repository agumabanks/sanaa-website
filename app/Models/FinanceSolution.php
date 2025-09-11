<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceSolution extends Model
{
    protected $fillable = [
        'title','audience','description','icon','link','sort_order','is_active'
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}

