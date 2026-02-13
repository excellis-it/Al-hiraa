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
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city');
    }

    public function associate()
    {
        return $this->belongsTo(Associate::class, 'associate_id');
    }
}
