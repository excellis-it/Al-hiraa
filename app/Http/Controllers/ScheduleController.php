<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidatePosition;
use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\ReferralPoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('Manage Schedule')) {
            $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();

            $perPage = 15;
            $page = 1;

            $interviewsQuery = Interview::with(['company', 'job', 'user'])
                ->orderBy('id', 'DESC');

            $total = $interviewsQuery->count();

            $interviews = $interviewsQuery
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get()
                ->toArray();

            // Create pagination HTML
            $totalPages = ceil($total / $perPage);
            $paginationHtml = '';

            if ($totalPages > 1) {
                $paginationHtml = '<nav><ul class="pagination justify-content-center">';

                $paginationHtml .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';

                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == 1) {
                        $paginationHtml .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                    } else {
                        $paginationHtml .= '<li class="page-item"><a class="page-link pagination-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
                    }
                }

                if ($totalPages > 1) {
                    $paginationHtml .= '<li class="page-item"><a class="page-link pagination-link" href="#" data-page="2">Next</a></li>';
                } else {
                    $paginationHtml .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
                }

                $paginationHtml .= '</ul></nav>';
            }

            return view('schedule.list')->with(compact('companies', 'interviews', 'paginationHtml'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'job_id' => 'required|array',
            'interview_location' => 'required',
            'interview_date' => 'required|date|after_or_equal:today',
        ], [
            'company_id.required' => 'The company field is required.',
            'job_id.required' => 'The job field is required.',
            'interview_date.required' => 'The interview date field is required.',
            'interview_date.after_or_equal' => 'The interview date cannot be in the past.',
        ]);

        $interviewDate = date('d-m-Y', strtotime($request->interview_date));
        $interviewDateSystem = date('Y-m-d', strtotime($request->interview_date));

        $createdInterviews = [];

        foreach ($request->job_id as $jobId) {
            // check if interview already scheduled
            $checkInterview = Interview::where('company_id', $request->company_id)
                ->where('job_id', $jobId)
                ->where(function ($query) use ($interviewDateSystem) {
                    $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '<=', $interviewDateSystem)
                        ->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $interviewDateSystem);
                })
                ->first();

            if ($checkInterview) {
                $job = Job::find($jobId);
                return response()->json(['status' => false, 'message' => "Interview already scheduled for job: {$job->job_name} on this date."]);
            }

            $interview = new Interview();
            $interview->user_id = Auth::user()->id;
            $interview->company_id = $request->company_id;
            $interview->interview_location = $request->interview_location;
            $interview->job_id = $jobId;
            $interview->interview_start_date = $interviewDate;
            $interview->interview_end_date = $interviewDate;
            $interview->interview_status = 'Working';

            // Auto-generate and save interview_id
            $interview->interview_id = $interview->generateInterviewId();
            $interview->save();

            $createdInterviews[] = $interview;
        }

        Session::flash('message', 'Interview(s) scheduled successfully.');
        return response()->json(['status' => true, 'message' => 'Interview(s) scheduled successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $interview = Interview::find($id);
        $jobs = Company::find($interview->company_id)->jobs;
        $edit = true;
        return response()->json(['view' => view('schedule.edit', compact('interview', 'jobs', 'edit'))->render(), 'status' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'job_id' => 'required',
            'interview_location' => 'required',
            'interview_date' => 'required|date|after_or_equal:today',
        ], [
            'job_id.required' => 'The job field is required.',
            'interview_date.required' => 'The interview date field is required.',
            'interview_date.after_or_equal' => 'The interview date cannot be in the past.',
        ]);

        $id = Crypt::decrypt($id);
        $interview = Interview::find($id);

        $interviewDateSystem = date('Y-m-d', strtotime($request->interview_date));
        $interviewDate = date('d-m-Y', strtotime($request->interview_date));

        $checkInterview = Interview::where('company_id', $interview->company_id)
            ->where('job_id', $request->job_id)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($interviewDateSystem) {
                $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '<=', $interviewDateSystem)
                    ->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $interviewDateSystem);
            })
            ->first();

        if ($checkInterview) {
            return response()->json(['status' => false, 'message' => 'Interview already scheduled for this job on this date.']);
        }

        $interview->interview_location = $request->interview_location;
        $interview->job_id = $request->job_id;
        $interview->interview_start_date = $interviewDate;
        $interview->interview_end_date = $interviewDate;
        $interview->save();

        Session::flash('message', 'Interview updated successfully.');
        return response()->json(['view' => view('schedule.single-row-update', compact('interview'))->render(), 'interview' => $interview, 'status' => true, 'message' => 'Interview updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getJobList(Request $request)
    {
        $company_id = $request->company_id;
        $jobs = Company::find($company_id)->jobs;
        return response()->json($jobs);
    }

    public function jobCreate(string $id)
    {
        $id = Crypt::decrypt($id);
        $company = Company::find($id);
        $positions = CandidatePosition::where('is_active', 1)->orderBy('name', 'ASC')->get();
        $add = true;
        $referral_points = ReferralPoint::orderBy('id', 'DESC')->get();
        $vendors = User::role('VENDOR')->orderBy('first_name', 'ASC')->get();
        return response()->json(['view' => view('schedule.add-task', compact('company', 'add', 'positions', 'vendors', 'referral_points'))->render(), 'status' => 'success']);
    }

    public function getJobCreateUrl($id)
    {
        $encryptedId = Crypt::encrypt($id);
        return response()->json([
            'url' => route('schedule-to-do.job-create', $encryptedId)
        ]);
    }

    public function filter(Request $request)
    {
        $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();

        // Get filter parameters - treat empty strings as null
        $search = $request->input('search') ?: null;
        $companyId = $request->input('company_id') ?: null;
        $date = $request->input('date') ?: null;
        $page = $request->input('page', 1);
        $perPage = 15;

        // Query the interviews with search and filter conditions
        $interviewsQuery = Interview::with(['company', 'job', 'user'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('company', function ($subQ) use ($search) {
                        $subQ->where('company_name', 'like', '%' . $search . '%');
                    })->orWhereHas('job', function ($subQ) use ($search) {
                        $subQ->where('job_name', 'like', '%' . $search . '%')
                            ->orWhere('job_id', 'like', '%' . $search . '%');
                    })->orWhereHas('user', function ($subQ) use ($search) {
                        $subQ->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                    })->orWhere('interview_location', 'like', '%' . $search . '%')
                    ->orWhere('interview_id', 'like', '%' . $search . '%');
                });
            })
            ->when($companyId, function ($query, $companyId) {
                $query->where('company_id', $companyId);
            })
            ->when($date, function ($query, $date) {
                // Convert date to Y-m-d format for comparison
                $formattedDate = date('Y-m-d', strtotime($date));
                $query->where(function ($q) use ($formattedDate) {
                    $q->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '<=', $formattedDate)
                        ->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $formattedDate);
                });
            })
            ->orderBy('id', 'DESC');

        // Get total count for pagination
        $total = $interviewsQuery->count();

        // Apply pagination
        $interviews = $interviewsQuery
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get()
            ->toArray();

        // Create pagination HTML
        $totalPages = ceil($total / $perPage);
        $paginationHtml = '';

        if ($totalPages > 1) {
            $paginationHtml = '<nav><ul class="pagination justify-content-center">';

            // Previous button
            if ($page > 1) {
                $paginationHtml .= '<li class="page-item"><a class="page-link pagination-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
            } else {
                $paginationHtml .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
            }

            // Page numbers
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    $paginationHtml .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    $paginationHtml .= '<li class="page-item"><a class="page-link pagination-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
                }
            }

            // Next button
            if ($page < $totalPages) {
                $paginationHtml .= '<li class="page-item"><a class="page-link pagination-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
            } else {
                $paginationHtml .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
            }

            $paginationHtml .= '</ul></nav>';
        }

        return response()->json([
            'view' => view('schedule.results', compact('companies', 'interviews', 'paginationHtml'))->render()
        ]);
    }
}
