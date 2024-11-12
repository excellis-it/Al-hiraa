<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class JobInterviewReport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $year;
    protected $month;
    protected $company_id;

    public function __construct($year, $month, $company_id = null)
    {
        $this->year = $year;
        $this->month = $month;
        $this->company_id = $company_id;
    }

    public function view(): View
    {
        $companies = Company::query();
        if ($this->company_id) {
            $companies = $companies->where('id', $this->company_id);
        }

        $companies = $companies->orderBy('company_name', 'asc')->get();

        // dd($jobs);
        return view('export.job-interview-report-export', [
            'companies' => $companies,
            'new_month' => $this->month,
            'new_year' => $this->year,
        ]);
    }
}
