<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'full_text',
        'created_at',
        'updated_at',
    ];

    public function ratings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_ratings')->withPivot('type');
    }

    public function likes()
    {
        return $this->ratings()->where('post_ratings.type', 'like');
    }

    public function dislikes()
    {
        return $this->ratings()->where('post_ratings.type', 'dislike');
    }
}
