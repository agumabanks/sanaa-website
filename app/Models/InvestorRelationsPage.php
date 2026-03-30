<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorRelationsPage extends Model
{
    use HasFactory;

    protected $table = 'investor_relations_pages';

    protected $fillable = [
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'last_updated_by',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

