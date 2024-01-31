<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'candidate_id',
        'remarks',
        'call_status',
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
