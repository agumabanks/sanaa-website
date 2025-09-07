<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    /**
     * User-authored blog posts.
     */
    public function blogs()
    {
        return $this->hasMany(\App\Models\Blog::class, 'author_id');
    }

    /**
     * Posts saved to the user's library.
     */
    public function savedBlogs()
    {
        return $this->belongsToMany(\App\Models\Blog::class, 'blog_user_saves')->withTimestamps();
    }

    /**
     * Followers and following relationships.
     */
    public function followers()
    {
        return $this->belongsToMany(self::class, 'user_follows', 'following_id', 'follower_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(self::class, 'user_follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followedCategories()
    {
        return $this->belongsToMany(\App\Models\BlogCategory::class, 'user_follow_categories', 'user_id', 'category_id')->withTimestamps();
    }

    public function followedTags()
    {
        return $this->belongsToMany(\App\Models\BlogTag::class, 'user_follow_tags', 'user_id', 'tag_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\BlogComment::class);
    }
}
