<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'link',
        'image',
    ];
}
