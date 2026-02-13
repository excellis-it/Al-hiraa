<?php

namespace App\Http\Controllers;

use App\Models\Lineup;
use App\Models\LineupStatusLog;
use App\Models\Company;
use App\Models\Job;
use App\Models\Interview;
use App\Exports\LineupsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LineupController extends Controller
{
    /**
     * Display a listing of lineups with filters
     */
    public function index(Request $request)
    {
        if (!Auth::user()->can('Manage Lineup')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        $today = date('Y-m-d');

        // Get companies with future interviews
        $companies = Company::where('status', 1)
            ->whereHas('interviews', function ($query) use ($today) {
                $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '>=', $today);
            })
            ->orderBy('company_name', 'asc')
            ->get();

        // Build query for lineups
        // removed date filter to show all lineups
        $query = Lineup::with([
            'candidate',
            'interview',
            'interview.job',
            'interview.company',
            'job',
            'statusUpdater'
        ]);

        // Apply filters
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        if ($request->filled('interview_id')) {
            $query->where('interview_id', $request->interview_id);
        }

        if ($request->filled('interview_status')) {
            $query->where('interview_status', $request->interview_status);
        }

        if ($request->filled('assign_by_id')) {
            $query->where('assign_by_id', $request->assign_by_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('candidate', function ($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                    ->orWhere('passport_number', 'LIKE', "%{$search}%")
                    ->orWhere('contact_no', 'LIKE', "%{$search}%")
                    ->orWhere('whatapp_no', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('gender', 'LIKE', "%{$search}%");
            });
        }

        // Get lineups ordered by interview date
        $perPage = $request->get('per_page', 20);
        $lineups = $query->orderBy(
            DB::raw('(SELECT STR_TO_DATE(interview_start_date, "%d-%m-%Y") FROM interviews WHERE interviews.id = lineups.interview_id)'),
            'asc'
        )->paginate($perPage);

        // Get selected filter values for cascading dropdowns
        $selectedCompany = $request->company_id;
        $selectedJob = $request->job_id;
        $selectedInterview = $request->interview_id;

        // Get jobs for selected company
        $jobs = collect();
        if ($selectedCompany) {
            $jobs = Job::where('company_id', $selectedCompany)
                ->where('status', 'Ongoing')
                ->whereHas('interviews', function ($query) use ($today) {
                    $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '>=', $today);
                })
                ->get();
        }

        // Get interviews for selected job
        $interviews = collect();
        if ($selectedJob) {
            $interviews = Interview::where('job_id', $selectedJob)
                ->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '>=', $today)
                ->orderBy(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), 'asc')
                ->get();
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('lineups.table', compact('lineups'))->render(),
                'status' => 'success'
            ]);
        }

        return view('lineups.index', compact(
            'lineups',
            'companies',
            'jobs',
            'interviews',
            'selectedCompany',
            'selectedJob',
            'selectedInterview'
        ));
    }

    /**
     * Display the specified lineup details (AJAX)
     */
    public function show($id)
    {
        $lineup = Lineup::with([
            'candidate',
            'interview',
            'interview.job',
            'interview.company',
            'statusUpdater',
            'statusLogs',
            'statusLogs.updater'
        ])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'html' => view('lineups.show', compact('lineup'))->render()
        ]);
    }

    /**
     * Update the lineup status (AJAX)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'interview_status' => 'required',
            'status_remarks' => 'nullable|string'
        ]);

        $lineup = Lineup::findOrFail($id);
        $lineup->update([
            'interview_status' => $request->interview_status,
            'status_remarks' => $request->status_remarks,
            'status_updated_by' => Auth::id()
        ]);

        // Log the change
        LineupStatusLog::create([
            'lineup_id' => $lineup->id,
            'status' => $request->interview_status,
            'remarks' => $request->status_remarks,
            'updated_by' => Auth::id()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Lineup status updated successfully'
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new LineupsExport($request->all()), 'lineups_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    /**
     * Get jobs for a selected company (AJAX)
     */
    public function getJobsByCompany(Request $request)
    {
        $today = date('Y-m-d');
        $companyId = $request->company_id;

        $jobs = Job::where('company_id', $companyId)
            ->where('status', 'Ongoing')
            ->whereHas('interviews', function ($query) use ($today) {
                $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '>=', $today);
            })
            ->get();

        return response()->json(['jobs' => $jobs, 'status' => 'success']);
    }

    /**
     * Get interview dates for selected job (AJAX)
     */
    public function getInterviewsByJob(Request $request)
    {
        $today = date('Y-m-d');
        $jobId = $request->job_id;

        $interviews = Interview::where('job_id', $jobId)
            ->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '>=', $today)
            ->orderBy(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), 'asc')
            ->get();

        if ($interviews->count() > 0) {
            return response()->json([
                'interviews' => $interviews,
                'status' => 'success'
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'No interviews found']);
    }
}
