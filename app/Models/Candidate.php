<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Candidate extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'candidates', $guard = 'candidate';


    protected $fillable = [
        'enter_by',
        'cnadidate_status_id',
        'mode_of_registration',
        'source',
        'referred_by',
        'last_update_date',
        'full_name',
        'gender',
        'date_of_birth',
        'age',
        'education',
        'other_education',
        'contact_no',
        'alternate_contact_no',
        'email',
        'whatapp_no',
        'city',
        'religion',
        'ecr_type',
        'english_speak',
        'arabic_speak',
        'position_applied_for_1',
        'specialisation_1',
        'position_applied_for_2',
        'specialisation_2',
        'position_applied_for_3',
        'specialisation_3',
        'indian_exp',
        'abroad_exp',
        'remarks',
        'passport_number',
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        if ($key !== 'cv' && !is_null($value)) {
            $value = strtoupper($value);
        }
        return parent::setAttribute($key, $value); // Ensure you return the parent call
    }



    public function candidateFieldUpdate()
    {
        return $this->hasOne(CandidateFieldUpdate::class)->orderBy('id', 'desc')->where('is_granted', 1);
    }

    public function candidateStatus()
    {
        return $this->belongsTo(CandidateStatus::class, 'cnadidate_status_id')->orderBy('id', 'desc');
    }

    public function enterBy()
    {
        return $this->belongsTo(User::class, 'enter_by', 'id');
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by_id', 'id');
    }

    public function referredByCandidate()
    {
        return $this->belongsTo(Candidate::class, 'referred_by_id', 'id');
    }

    public function candidateUpdate()
    {
        return $this->hasOne(CandidateUpdated::class)->orderBy('id', 'desc');
    }

    public function candidateIndianLicence()
    {
        return $this->hasMany(CandidateLicence::class)->where('licence_type', 'indian');
    }

    public function candidateGulfLicence()
    {
        return $this->hasMany(CandidateLicence::class)->where('licence_type', 'gulf');
    }

    public function lastCandidateActivity()
    {
        return $this->hasOne(CandidateActivity::class)->orderBy('id', 'desc');
    }

    public function candidateActivity()
    {
        return $this->hasMany(CandidateActivity::class);
    }

    public function positionAppliedFor1()
    {
        return $this->belongsTo(CandidatePosition::class, 'position_applied_for_1');
    }

    public function positionAppliedFor2()
    {
        return $this->belongsTo(CandidatePosition::class, 'position_applied_for_2');
    }

    public function positionAppliedFor3()
    {
        return $this->belongsTo(CandidatePosition::class, 'position_applied_for_3');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city');
    }

    public function associatedBy()
    {
        return $this->belongsTo(User::class, 'associate_id');
    }
}
