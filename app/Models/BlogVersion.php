<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'version_number',
        'title',
        'body',
        'excerpt',
        'changes_summary',
        'created_by',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

