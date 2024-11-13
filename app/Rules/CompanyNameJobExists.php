<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CompanyNameJobExists implements Rule
{
    protected $companyName;
    protected $jobTitle;
    protected $companyLocation;

    public function __construct($companyName, $jobTitle , $companyLocation)
    {
        $this->companyName = $companyName;
        $this->jobTitle = $jobTitle;
        $this->companyLocation = $companyLocation;
    }

    public function passes($attribute, $value)
    {
        return DB::table('jobs')
            ->join('companies', 'jobs.company_id', '=', 'companies.id')
            ->where('companies.company_name', $this->companyName)
            ->where('companies.company_address', $this->companyLocation)
            ->where('jobs.job_name', $this->jobTitle)
            ->exists();
    }

    public function message()
    {
        return 'The company name and job title does not exist of the ' . $this->companyName . ' company with ' . $this->jobTitle . ' job title on our records.';
    }
}
