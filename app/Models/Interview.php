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
        // Get date from interview start date in dd-mm-yyyy format
        if ($this->interview_start_date) {
            // If already in dd-mm-yyyy format, use it directly
            if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $this->interview_start_date)) {
                $date = $this->interview_start_date;
            } else {
                // Convert from other format to dd-mm-yyyy
                $date = date('d-m-Y', strtotime($this->interview_start_date));
            }
        } else {
            $date = date('d-m-Y');
        }

        $positionName = 'NA';
        $positionId = null;

        // Try to get position name via relationship if loaded, otherwise fallback to database query
        if ($this->relationLoaded('job') && $this->job && $this->job->candidatePosition) {
            $positionName = $this->job->candidatePosition->name;
            $positionId = $this->job->candidate_position_id;
        } elseif ($this->job_id) {
            $tempJob = Job::with('candidatePosition')->find($this->job_id);
            if ($tempJob && $tempJob->candidatePosition) {
                $positionName = $tempJob->candidatePosition->name;
                $positionId = $tempJob->candidate_position_id;
            }
        }

        // Sanitize and shorten position name for code
        $posCode = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $positionName), 0, 3));
        if (empty($posCode)) $posCode = 'AL';

        // Create unique sequential number for this date and position combination
        // Find existing interviews with same date and position to get next sequence number
        $interviewDate = $this->interview_start_date;
        $existingCount = Interview::whereHas('job', function ($query) use ($positionId) {
            if ($positionId) {
                $query->where('candidate_position_id', $positionId);
            }
        })
            ->where('interview_start_date', $interviewDate)
            ->where('id', '!=', $this->id ?? 0) // Exclude current record when updating
            ->count();

        // Sequential number starts from 1
        $sequenceNum = str_pad($existingCount + 1, 3, '0', STR_PAD_LEFT);

        return "AL-{$date}-{$posCode}-{$sequenceNum}";
    }
}
