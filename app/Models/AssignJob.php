<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignJob extends Model
{
    use HasFactory;

    protected $table = 'assign_jobs';

    protected $fillable = [
        'candidate_id',
        'job_id',
        'company_id',
        'user_id',
        'interview_id',
        'interview_status'
    ];

    public function getAllFields()
    {
        return array_map('strtoupper', $this->fillable);
    }

    public function setAttribute($key, $value)
    {
        $value = strtoupper($value);
        return parent::setAttribute($key, $value); // Ensure you return the parent call
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class, 'interview_id', 'id');
    }
}
