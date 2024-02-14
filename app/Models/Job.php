<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_id',
        'candidate_position_id',
        'state_id',
        'city_id',
        'job_name',
        'duty_hours',
        'contract',
        'benifits',
        'address', // 'address' is a typo, it should be 'benefits
        'job_description',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function candidatePosition()
    {
        return $this->belongsTo(CandidatePosition::class, 'candidate_position_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
