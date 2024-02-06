<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            if (Auth::user()->hasRole('ADMIN')) {
                $interviews = Interview::with(['company', 'job','user'])
                    ->orderBy('id', 'DESC')
                    ->get();

                $interviews = $interviews->groupBy(function ($interview) {
                    return $interview->company->company_name;
                });

                $interviews = $interviews->mapWithKeys(function ($item, $key) {
                    return [$key => $item->toArray()];
                });
                // dd($interviews);
            } else {
                $interviews = Interview::join('companies', 'interviews.company_id', '=', 'companies.id')
                    ->select('interviews.*', 'companies.company_name as company_name')
                    ->where('interviews.user_id', Auth::user()->id)
                    ->get()
                    ->groupBy('company_name')
                    ->mapWithKeys(function ($item, $key) {
                        return [$key => $item->toArray()];
                    })->toArray();
            }
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
            'interview_start_date' => 'nullable|date',
            'interview_end_date' => 'required|date|after:interview_start_date',
            'interview_status' => 'required',
        ], [
            'company_id.required' => 'The company field is required.',
            'job_id.required' => 'The job field is required.',
            'interview_start_date.required' => 'The interview start date field is required.',
            'interview_end_date.required' => 'The interview end date field is required.',
            'interview_status.required' => 'The interview status field is required.',
        ]);

        $interview = new Interview();
        $interview->user_id = Auth::user()->id;
        $interview->company_id = $request->company_id;
        $interview->job_id = $request->job_id;
        $interview->interview_start_date = $request->interview_start_date;
        $interview->interview_end_date = $request->interview_end_date;
        $interview->interview_status = $request->interview_status;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
}
