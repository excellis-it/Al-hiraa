<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CompanyNameLocationExists implements Rule
{
    protected $companyName;
    protected $companyLocation;

    public function __construct($companyName, $companyLocation)
    {
        $this->companyName = $companyName;
        $this->companyLocation = $companyLocation;
    }

    public function passes($attribute, $value)
    {
        return DB::table('companies')
            ->where('company_name', $this->companyName)
            ->where('company_address', $this->companyLocation)
            ->exists();
    }

    public function message()
    {
        return 'The company name and location does not exist of the ' . $this->companyName . ' company at ' . $this->companyLocation . ' location on our records.';
    }
}
