<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceTestimonial extends Model
{
    protected $fillable = [
        'quote','author','role','company','logo','rating','sort_order','is_active'
    ];

    protected $casts = [
        'rating' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}

