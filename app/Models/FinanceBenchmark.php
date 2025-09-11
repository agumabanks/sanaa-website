<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceBenchmark extends Model
{
    protected $fillable = [
        'metric','sanaa_value','competitor_value','footnote','as_of_date'
    ];

    protected $casts = [
        'as_of_date' => 'date',
    ];
}

