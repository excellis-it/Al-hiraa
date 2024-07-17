<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CandidateReferralPoint extends Model
{
    use HasFactory;

    //refer candidate relation

    public function referCandidate()
    {
        return $this->belongsTo(Candidate::class, 'refer_candidate_id');
    }

    //refer job relation
    
    public function referJob()
    {
        return $this->belongsTo(Job::class, 'refer_job_id');
    }
}
