<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatePosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'is_active',
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
