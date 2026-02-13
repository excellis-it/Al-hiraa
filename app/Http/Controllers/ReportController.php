<?php

namespace App\Http\Controllers;

use App\Exports\CandidateInterviewExport;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function candidateInterview()
    {
        $candidates = Candidate::orderBy('full_name', 'ASC')->whereHas('CandidateJob')->get();
        return view('reports.candidate-interview', compact('candidates'));
    }
    public function getCandidates(Request $request)
    {
        $search = $request->input('search'); // Search term
        $page = $request->input('page', 1); // Current page
        $perPage = 10; // Results per page

        $query = Candidate::whereNotNull('passport_number')->query();

        if ($search) {
            $query->where('full_name', 'like', '%' . $search . '%');
        }

        $candidates = $query->whereHas('CandidateJob')->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'results' => $candidates->map(function ($candidate) {
                return [
                    'id' => $candidate->id,
                    'text' => $candidate->full_name . ' (' . $candidate->contact_no . ')',
                ];
            }),
            'pagination' => [
                'more' => $candidates->hasMorePages(), // Flag to indicate more pages
            ],
        ]);
    }

    public function candidateInterviewExport(Request $request)
    {
        // Get the selected candidate IDs from the request
        $candidateIds = $request->input('passport_number'); // or use a different name if necessary

        // Ensure candidates are selected
        if (!$candidateIds) {
            return redirect()->back()->with('error', 'Please select at least one candidate.');
        }

        // Export the selected candidates
        return Excel::download(new CandidateInterviewExport($candidateIds), 'candidates_interview.xlsx');
    }
}
