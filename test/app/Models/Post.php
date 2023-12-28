<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title', 'content',
        'published_at', 'published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    protected $dates = [
        'published_at',
    ];

    public function isPublished(): bool
    {
        return $this->published && $this->published_at;
    }

}
