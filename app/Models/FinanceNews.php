<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceNews extends Model
{
    protected $fillable = [
        'title','url','source','tag','published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}

