<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'document',
        'status',
        'service_charge',
        'associate_charge',
        'salary'
    ];

    public function getAllFields()
    {
        $fields = $this->fillable;
        $fields = array_map(function ($field) {
            return $field === 'document' ? $field : strtoupper($field);
        }, $fields);

        return $fields;
    }

    public function setAttribute($key, $value)
    {
        if ($key !== 'document' && !is_null($value)) {
            $value = strtoupper($value);
        }
        return parent::setAttribute($key, $value); // Ensure you return the parent call
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
        $today = date('Y-m-d');
        return $this->hasOne(Interview::class, 'job_id')->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $today);
    }

    public function last_interview()
    {
        return $this->hasOne(Interview::class, 'job_id')->latest();
    }
}
