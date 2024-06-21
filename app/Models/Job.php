<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    protected $fillable = [
        'vendor_id',
        'company_id',
        'candidate_position_id',
        'job_name',
        'duty_hours',
        'contract',
        'benifits',
        'address', // 'address' is a typo, it should be 'benefits
        'job_description',
        'status',
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        if ($value !== null) {
            $value = strtoupper($value);
        }
        parent::setAttribute($key, $value);
    }

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

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'job_id');
    }

    public function presentInterview()
    {
        return $this->hasOne(Interview::class, 'job_id')->where('interview_start_date', '>=', date('Y-m-d'))->orWhere('interview_end_date', '>=', date('Y-m-d'));
    }
}
