<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceClient extends Model
{
    protected $fillable = [
        'name','logo','blurb','site','sort_order','is_active'
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}

