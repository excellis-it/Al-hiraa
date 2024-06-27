<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    public function feedFiles()
    {
        return $this->hasMany(FeedFile::class, 'feed_id', 'id');
    }
}
