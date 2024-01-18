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

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
