<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceStat extends Model
{
    protected $fillable = [
        'label','value','source','as_of_date','sort_order'
    ];

    protected $casts = [
        'as_of_date' => 'date',
        'sort_order' => 'integer',
    ];
}

