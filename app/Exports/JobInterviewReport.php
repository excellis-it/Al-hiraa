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

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }


    public function view(): View
    {
        $companies = Company::orderBy('company_name', 'asc')->get();
        // dd($jobs);
        return view('export.job-interview-report-export', [
            'companies' => $companies,
            'new_month' => $this->month,
            'new_year' => $this->year,
        ]);
    }
}
