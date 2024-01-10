<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

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
        'indian_driving_license',
        'international_driving_license',
        'english_speak',
        'arabic_speak',
        'return',
        'position',
        'indian_exp',
        'abroad_exp',
        'remarks',
    ];

    public function candidatePositions()
    {
        return $this->hasOne(CandidatePosition::class);
    }

    public function candidateStatus()
    {
        return $this->belongsTo(CandidateStatus::class, 'cnadidate_status_id');
    }

    public function enterBy()
    {
        return $this->belongsTo(User::class, 'enter_by', 'id');
    }


}
