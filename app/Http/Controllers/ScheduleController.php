<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidatePosition;
use App\Models\Company;
use App\Models\Interview;
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
            $companies = Company::orderBy('company_name', 'asc')->get();
            // if (Auth::user()->hasRole('ADMIN')) {
            $interviews = Interview::with(['company', 'job', 'user'])
                ->orderBy('id', 'DESC')
                ->get();

            $interviews = $interviews->groupBy(function ($interview) {
                return $interview->company->company_name ?? '';
            });

            $interviews = $interviews->mapWithKeys(function ($item, $key) {
                return [$key => $item->toArray()];
            });
            // } else {
            //     $interviews = Interview::join('companies', 'interviews.company_id', '=', 'companies.id')
            //         ->select('interviews.*', 'companies.company_name as company_name')
            //         ->get()
            //         ->groupBy('company_name')
            //         ->mapWithKeys(function ($item, $key) {
            //             return [$key => $item->toArray()];
            //         })->toArray();
            // }
            return view('schedule.list')->with(compact('companies', 'interviews'));
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
            'job_id' => 'required',
            'interview_location' => 'required',
            'interview_start_date' => 'nullable|date',
           'interview_end_date' => 'required|date|after_or_equal:interview_start_date',
        ], [
            'company_id.required' => 'The company field is required.',
            'job_id.required' => 'The job field is required.',
            'interview_start_date.required' => 'The interview start date field is required.',
            'interview_end_date.required' => 'The interview end date field is required.',
        ]);
        // check if interview already scheduled
        $interviewStartDate = date('Y-m-d', strtotime($request->interview_start_date));
        $interviewEndDate = date('Y-m-d', strtotime($request->interview_end_date));


        $checkInterview = Interview::where('company_id', $request->company_id)
            ->where('job_id', $request->job_id)
            ->where(function ($query) use ($interviewStartDate, $interviewEndDate) {
                // Check for overlapping dates while considering the correct format
                $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '<=', $interviewEndDate)
                    ->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $interviewStartDate);
            })
            ->first();


        if ($checkInterview) {
            return response()->json(['status' => false, 'message' => 'Interview already scheduled for this job.']);
        }

        $interview = new Interview();
        $interview->user_id = Auth::user()->id;
        $interview->company_id = $request->company_id;
        $interview->interview_location = $request->interview_location;
        $interview->job_id = $request->job_id;
        $interview->interview_start_date = $request->interview_start_date;
        $interview->interview_end_date = $request->interview_end_date;
        $interview->interview_status = 'Working';
        $interview->save();

        Session::flash('message', 'Interview scheduled successfully.');
        return response()->json(['status' => true, 'message' => 'Interview scheduled successfully.']);
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
            'interview_start_date' => 'nullable|date',
          'interview_end_date' => 'required|date|after_or_equal:interview_start_date',
        ], [
            'job_id.required' => 'The job field is required.',
            'interview_start_date.required' => 'The interview start date field is required.',
            'interview_end_date.required' => 'The interview end date field is required.',
        ]);



        $id = Crypt::decrypt($id);
        $interview = Interview::find($id);

        $interviewStartDate = date('Y-m-d', strtotime($request->interview_start_date));
        $interviewEndDate = date('Y-m-d', strtotime($request->interview_end_date));

        $checkInterview = Interview::where('company_id', $interview->company_id)
            ->where('job_id', $request->job_id)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($interviewStartDate, $interviewEndDate) {
                // Check for overlapping dates while considering the correct format
                $query->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '<=', $interviewEndDate)
                    ->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $interviewStartDate);
            })
            ->first();


        if ($checkInterview) {
            return response()->json(['status' => false, 'message' => 'Interview already scheduled for this job.']);
        }

        $interview->interview_location = $request->interview_location;
        $interview->job_id = $request->job_id;
        $interview->interview_start_date = $request->interview_start_date;
        $interview->interview_end_date = $request->interview_end_date;
        $interview->save();

        Session::flash('message', 'Interview updated successfully.');
        return response()->json(['status' => true, 'message' => 'Interview updated successfully.']);
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
}
