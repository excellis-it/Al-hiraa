<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    public function feedFiles()
    {
        return $this->hasMany(FeedFile::class, 'feed_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function feedLikes()
    {
        return $this->hasMany(FeedLike::class, 'feed_id', 'id');
    }

}
