<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;



    protected $fillable = [
        'user_id',
        'company_id',
        'job_id',
        'interview_id',
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

  

    public function generateInterviewId()
    {
        $date = $this->interview_start_date ? date('Ymd', strtotime($this->interview_start_date)) : date('Ymd');

        $positionName = 'NA';
        // Try to get position name via relationship if loaded, otherwise fallback to database query
        if ($this->relationLoaded('job') && $this->job && $this->job->candidatePosition) {
            $positionName = $this->job->candidatePosition->name;
        } elseif ($this->job_id) {
            $tempJob = Job::with('candidatePosition')->find($this->job_id);
            if ($tempJob && $tempJob->candidatePosition) {
                $positionName = $tempJob->candidatePosition->name;
            }
        }

        // Sanitize and shorten position name for code
        $posCode = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $positionName), 0, 3));
        if (empty($posCode)) $posCode = 'INT';

        $idPart = $this->id ? str_pad($this->id, 3, '0', STR_PAD_LEFT) : '000';
        return "INT-{$date}-{$posCode}-{$idPart}";
    }
}
