<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CandidateExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $candidates = Candidate::all();
        // dd($jobs);
        return view('candidates.export', [
            'candidates' => $candidates
        ]);
    }
}
