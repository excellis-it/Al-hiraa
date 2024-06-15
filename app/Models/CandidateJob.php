<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateJob extends Model
{
    use HasFactory;

    
    public function assignBy()
    {
        return $this->belongsTo(User::class, 'assign_by_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(Job::class, 'job_title');
    }

   
}
