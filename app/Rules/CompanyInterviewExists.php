<?php

namespace App\Rules;

use App\Models\Interview;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class CompanyInterviewExists implements Rule
{
    protected $companyName;
    protected $interviewEndDate;
    protected $companyLocation;
    protected $jobTitle;
    protected $startDate;

    public function __construct($companyName, $interviewEndDate, $companyLocation, $jobTitle, $startDate)
    {
        $this->companyName = $companyName;
        $this->interviewEndDate = $interviewEndDate;
        $this->companyLocation = $companyLocation;
        $this->jobTitle = $jobTitle;
        $this->startDate = $startDate;
    }

    public function passes($attribute, $value)
    {
        return Interview::where('interview_end_date', $this->interviewEndDate)
            ->where('interview_start_date', $this->startDate)->whereHas('company', function ($query) {
                $query->where('company_name', $this->companyName)
                    ->where('company_address', $this->companyLocation);
            })->whereHas('job', function ($query) {
                $query->where('job_name', $this->jobTitle);
            })
            ->exists();
    }

    public function message()
    {
        return 'The interview does not exist of the ' . $this->startDate . ' start date with ' . $this->interviewEndDate . ' end date on our records for the ' . $this->companyName . ' company with ' . $this->jobTitle . ' job title.';
    }
}
