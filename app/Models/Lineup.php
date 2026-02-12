<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'vendor_id',
        'interview_id',
        'full_name',
        'email',
        'gender',
        'date_of_birth',
        'whatapp_no',
        'alternate_contact_no',
        'religion',
        'city',
        'address',
        'education',
        'other_education',
        'passport_number',
        'english_speak',
        'arabic_speak',
        'assign_by_id',
        'job_id',
        'job_position',
        'job_location',
        'company_id',
        'date_of_interview',
        'interview_status',
    ];

    /**
     * Get the candidate that owns the lineup.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    /**
     * Get the vendor that owns the lineup.
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    /**
     * Get the interview that owns the lineup.
     */
    public function interview()
    {
        return $this->belongsTo(Interview::class, 'interview_id');
    }


    /**
     * Get the job that owns the lineup.
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    /**
     * Get the company that owns the lineup.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the user who assigned the lineup.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'assign_by_id');
    }

    // city relationship
    public function city()
    {
        return $this->belongsTo(City::class, 'city');
    }
}
