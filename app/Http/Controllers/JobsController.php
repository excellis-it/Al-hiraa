<?php

namespace App\Http\Controllers;

use App\Events\CallCandidateEndEvent;
use App\Events\CallCandidateEvent;
use App\Exports\CandidateExport;
use App\Imports\CandidateImport;
use App\Models\AssignJob;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use App\Models\CandidateFieldUpdate;
use App\Models\CandidateLicence;
use App\Models\CandidatePosition;
use App\Models\CandidateStatus;
use App\Models\CandidateUpdated;
use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\CandidateJob;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if (Auth::user()->can('Manage Job')) {
           
            if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
                $candidate_jobs = CandidateJob::orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)->paginate(50);
            } else {
                
                $candidate_jobs = CandidateJob::orderBy('id', 'desc')->paginate(50);
            }
            return view('jobs.list')->with(compact('candidate_jobs'));
        } else {
            
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $candidate_job_detail = CandidateJob::findOrFail($id);
        $candidate = Candidate::findOrFail($candidate_job_detail->candidate_id);
        $jobs = Job::where('status', 'Ongoing')->get();
        $indian_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'INDIAN')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'GULF')->pluck('licence_name')->toArray();
        $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
        $assign_job = AssignJob::where('candidate_id', $candidate->id)->orderBy('id', 'desc')->first();
        $companies = Company::orderBy('company_name', 'asc')->get();
        $edit = true;
        session()->put('candidate_id', $candidate->id);
        // if (!Auth::user()->hasRole('ADMIN') && !Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
        //     if ($candidate->is_call_id != null && $candidate->is_call_id != Auth::user()->id) {
        //         return response()->json(['message' => __('Candidate already called.'), 'status' => 'error']);
        //     } else {
        //         $candidate_update = new CandidateUpdated();
        //         $candidate_update->user_id = Auth::user()->id;
        //         $candidate_update->candidate_id = $candidate->id;
        //         $candidate_update->save();
        //         session()->put('candidate_id', $candidate->id);
        //         $candidate->is_call_id = Auth::user()->id;
        //         $candidate->save();
        //         event(new CallCandidateEvent($candidate->id));
        //     }
        // }

        return response()->json(['view' => view('jobs.edit', compact('candidate', 'candidate_job_detail', 'companies', 'candidate_positions', 'assign_job', 'edit', 'indian_driving_license', 'gulf_driving_license'))->render(), 'status' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'full_name' => 'required',
            
        ], [
            'cnadidate_status_id.required' => 'The status field is required.',
            'position_applied_for_1.required' => 'The position applied for field is required.',
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'whatapp_no.regex' => 'The whatapp no must be +91xxxxxxxxxx format.',
        ]);

        $candidate = Candidate::findOrFail($id);

        if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidate->cnadidate_status_id = $request->cnadidate_status_id;
        }
        
        if (!Auth::user()->hasRole('ADMIN') && !Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            event(new CallCandidateEndEvent($candidate->id));
        }
        Session::forget('candidate_id');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate'))->render(), 'status' => 'success']);
    }

    public function bulkStatusUpdate()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userAutoFill(Request $request)
    {
        
    }

    public function candidateFilter(Request $request)
    {
        return $request;
        // return $request->all();
        $candidates = Candidate::query();
        if ($request->search) {
            $main_search_text_arr = explode(',', $request->search);
            $position_id = CandidatePosition::whereIn('name', $main_search_text_arr)->pluck('id')->toArray();
            $candidates->whereIn('full_name', $main_search_text_arr)
                ->orWhereIn('gender', $main_search_text_arr)
                ->orWhereIn('age', $main_search_text_arr)
                ->orWhereIn('education', $main_search_text_arr)
                ->orWhereIn('position_applied_for_1',  $position_id)
                ->orWhereIn('position_applied_for_2',  $position_id)
                ->orWhereIn('position_applied_for_3',  $position_id)
                ->orWhereIn('email', $main_search_text_arr)
                ->orWhereIn('city', $main_search_text_arr)
                ->orWhereIn('religion', $main_search_text_arr)
                ->orWhereIn('ecr_type', $main_search_text_arr)
                ->orWhereIn('english_speak', $main_search_text_arr)
                ->orWhereIn('arabic_speak', $main_search_text_arr);
            // enter by
            // ->orWhereHas('enterBy', function ($query) use ($request) {
            //     $query->whereInRaw("CONCAT(first_name, ' ', last_name)",$main_search_text_arr );
            // });
            // date of birth 09.01.2021 format search
            // ->orWhereRaw("DATE_FORMAT(date_of_birth, '%d.%m.%Y') LIKE '%" . $request->search . "%'")
            // ->orWhereRaw("DATE_FORMAT(updated_at, '%d.%m.%Y') LIKE '%" . $request->search . "%'");
        }

        if ($request->has('cnadidate_status_id')) {
            if (is_array($request->cnadidate_status_id)) {
                $candidates->whereIn('cnadidate_status_id', $request->cnadidate_status_id);
            } else {
                $candidates->where('cnadidate_status_id', $request->cnadidate_status_id);
            }
        }

        if ($request->source) {
            $candidates->where('source', $request->source);
        }

        if ($request->has('gender')) {
            if (is_array($request->gender)) {
                $candidates->whereIn('gender', $request->gender);
            } else {
                $candidates->where('gender', $request->gender);
            }
        }

        if ($request->has('education')) {
            if (is_array($request->education)) {
                $candidates->whereIn('education', $request->education);
            } else {
                $candidates->where('education', $request->education);
            }
        }

        $positions = ['position_applied_for_1', 'position_applied_for_2', 'position_applied_for_3'];
        if ($request->position_applied_for || $request->position_applied_for_2 || $request->position_applied_for_3) {
            $candidates->where(function ($querys) use ($positions, $request) {
                foreach ($positions as $position) {
                    $querys->orWhereIn($position, $request->position_applied_for ?? [])
                        ->orWhereIn($position, $request->position_applied_for_2 ?? [])
                        ->orWhereIn($position, $request->position_applied_for_3 ?? []);
                }
            });
        }

        if ($request->english_speak) {
            $candidates->where('english_speak', $request->english_speak);
        }

        if ($request->arabic_speak) {
            $candidates->where('arabic_speak', $request->arabic_speak);
        }

        if ($request->ecr_type) {
            $candidates->where('ecr_type', $request->ecr_type);
        }



        if ($request->city) {
            $candidates->where('city', $request->city);
        }

        if ($request->mode_of_registration) {
            $candidates->where('mode_of_registration', $request->mode_of_registration);
        }

        if ($request->last_call_status) {
            $last_activity = CandidateActivity::orderBy('id', 'desc')->get()->groupBy('candidate_id');
            $last_activity = $last_activity->map(function ($item, $key) {
                return $item->first();
            });

            $candidates->whereHas('candidateActivity', function ($query) use ($request, $last_activity) {
                $query->where('call_status', $request->last_call_status)->whereIn('id', $last_activity->pluck('id')->toArray());
            });
        }

        if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidates->where('enter_by', Auth::user()->id);
        }

        $candidates = $candidates->orderBy('id', 'desc')->paginate(50);

        return response()->json(['view' => view('jobs.filter', compact('candidates'))->render()]);
    }


  
}
