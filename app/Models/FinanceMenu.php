<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceMenu extends Model
{
    protected $fillable = [
        'label','url','parent_id','sort_order','is_external','is_active','group'
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_external' => 'boolean',
        'is_active' => 'boolean',
    ];
}

