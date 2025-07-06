<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'product',
        'message',
    ];
}
