<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($interview) {
            if (!$interview->interview_create_time) {
                $interview->interview_create_time = date('H:i');
            }
        });

        static::created(function ($interview) {
            if (!$interview->interview_id) {
                $interview->interview_id = $interview->generateInterviewId();
                $interview->save();
            }
        });

        static::updating(function ($interview) {
            if ($interview->isDirty(['interview_start_date', 'job_id'])) {
                $interview->interview_id = $interview->generateInterviewId();
            }
        });
    }

    protected $fillable = [
        'user_id',
        'company_id',
        'job_id',
        'interview_id',
        'interview_create_time',
        'interview_start_date',
        'interview_end_date',
        'interview_status',
        'interview_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function getInterviewIdAttribute($value)
    {
        if ($value) {
            return $value;
        }

        return $this->id ? $this->generateInterviewId() : null;
    }

    public function generateInterviewId()
    {
        $date = $this->interview_start_date ? date('Ymd', strtotime($this->interview_start_date)) : date('Ymd');
        $position = 'NA';
        if ($this->job && $this->job->candidatePosition) {
            $position = $this->job->candidatePosition->name;
        } elseif ($this->job_id) {
            $tempJob = Job::with('candidatePosition')->find($this->job_id);
            if ($tempJob && $tempJob->candidatePosition) {
                $position = $tempJob->candidatePosition->name;
            }
        }

        $posCode = strtoupper(substr(str_replace(' ', '', $position), 0, 3));
        $idPart = $this->id ? str_pad($this->id, 3, '0', STR_PAD_LEFT) : '000';
        return "INT-{$date}-{$posCode}-{$idPart}";
    }
}
