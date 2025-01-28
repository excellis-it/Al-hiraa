<?php

namespace App\Http\Controllers;

use App\Events\CallCandidateEndEvent;
use App\Exports\CandidateJobExport;
use App\Imports\CandidateJobImport;
use App\Jobs\SendJobSms;
use App\Jobs\SendJobWhatsapp;
use App\Models\AssignJob;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use App\Models\CandidatePosition;
use App\Models\Company;
use App\Models\Job;
use App\Models\CandidateJob;
use App\Models\User;
use App\Models\CandJobLicence;
use App\Models\ReferralPoint;
use App\Models\CandidateReferralPoint;
use App\Services\TextlocalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $textlocalService;

    public function __construct(TextlocalService $textlocalService)
    {
        $this->textlocalService = $textlocalService;
    }

    public function index(Request $request)
    {
        $interestedType = $request->input('interested_type'); // 'self' or 'team'
        $interviewId = $request->input('interview_id'); // Company ID or related identifier

        if (Auth::user()->can('Manage Job')) {
            if (Auth::user()->hasRole('DATA ENTRY OPERATOR') || Auth::user()->hasRole('RECRUITER')) {
                // Filter candidate jobs based on 'self' type
                $candidate_jobs = CandidateJob::orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)
                    ->where('job_interview_status', '!=', 'Not-Interested');
                $candidates = CandidateJob::orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)
                    ->where('job_interview_status', '!=', 'Not-Interested');

                if ($interestedType === 'self' && $interviewId) {
                    $candidate_jobs->where('interview_id', $interviewId); // Adjust to match your company relationship
                    $candidates->where('interview_id', $interviewId); // Adjust to match your company relationship
                }

                $candidate_jobs = $candidate_jobs->paginate(15);
                $candidates = $candidates->get();
            } else {
                // For other roles, fetch all candidate jobs
                $candidate_jobs = CandidateJob::orderBy('id', 'desc')
                    ->where('job_interview_status', '!=', 'Not-Interested');
                $candidates = CandidateJob::orderBy('id', 'desc')->where('job_interview_status', '!=', 'Not-Interested');

                if ($interestedType === 'team' && $interviewId) {
                    $candidate_jobs->where('interview_id', $interviewId); // Adjust to match your company relationship
                    $candidates->where('interview_id', $interviewId); // Adjust to match your company relationship
                }

                $candidate_jobs = $candidate_jobs->paginate(15);
                $candidates = $candidates->get();

                // Fetch all candidates for all users

            }

            $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->with('jobs')->get();

            // Initialize counts
            $count = [
                'total_interviews' => 0,
                'total_appeared' => 0,
                'total_selection' => 0,
                'total_medical' => 0,
                'total_doc' => 0,
                'total_collection' => 0,
                'total_deployment' => 0,
            ];

            // Loop through candidates to calculate counts
            foreach ($candidates as $candidate) {
                if (
                    is_null($candidate->deployment_date) &&
                    is_null($candidate->total_amount) &&
                    is_null($candidate->visa_receiving_date) &&
                    is_null($candidate->medical_status) &&
                    ($candidate->job_interview_status != 'Appeared') &&
                    ($candidate->job_interview_status != 'Not-Interested') &&
                    ($candidate->job_interview_status === 'Interested')
                ) {
                    $count['total_interviews']++;
                } elseif (
                    is_null($candidate->deployment_date) &&
                    is_null($candidate->total_amount) &&
                    is_null($candidate->visa_receiving_date) &&
                    is_null($candidate->medical_status) &&
                    $candidate->job_interview_status === 'Appeared'
                ) {
                    $count['total_appeared']++;
                } elseif (
                    $candidate->job_interview_status === 'Selected' &&
                    is_null($candidate->deployment_date) &&
                    is_null($candidate->total_amount) &&
                    is_null($candidate->visa_receiving_date) &&
                    is_null($candidate->medical_status)
                ) {
                    $count['total_selection']++;
                } elseif (
                    !is_null($candidate->medical_status) &&
                    is_null($candidate->deployment_date) &&
                    is_null($candidate->total_amount) &&
                    is_null($candidate->visa_receiving_date)
                ) {
                    $count['total_medical']++;
                } elseif (
                    !is_null($candidate->visa_receiving_date) &&
                    is_null($candidate->deployment_date) &&
                    is_null($candidate->total_amount)
                ) {
                    $count['total_doc']++;
                } elseif (
                    !is_null($candidate->total_amount) &&
                    is_null($candidate->deployment_date)
                ) {
                    $count['total_collection']++;
                } elseif (!is_null($candidate->deployment_date)) {
                    $count['total_deployment']++;
                }
            }

            // Return the view with the required data
            return view('jobs.list', compact('candidate_jobs', 'companies', 'count'));
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
    public function store(Request $request) {}

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
        $users = User::where('is_active', 1)->get();
        $candidate_job_detail = CandidateJob::findOrFail($id);
        // dd($candidate_job_detail);
        $candidate = Candidate::findOrFail($candidate_job_detail->candidate_id);
        $jobs = Job::where('status', 'Ongoing')->get();
        $indian_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'indian')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray();
        $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
        $assign_job = AssignJob::where('candidate_id', $candidate->id)->orderBy('id', 'desc')->first();
        $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();
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

        return response()->json(['view' => view('jobs.edit', compact('candidate', 'jobs', 'candidate_job_detail', 'users', 'companies', 'candidate_positions', 'assign_job', 'edit', 'indian_driving_license', 'gulf_driving_license'))->render(), 'status' => 'success']);
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

    public function bulkStatusUpdate() {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userAutoFill(Request $request) {}

    public function candidatejobFilter(Request $request)
    {
        // Retrieve request parameters
        $search = $request->search;
        $job_id = $request->job_id;
        $company = $request->company;
        $int_pipeline = $request->int_pipeline;
        $interestedType = $request->interestedType;  // Get interestedType
        $interviewId = $request->interviewId;        // Get interviewId

        // Initialize query
        $query = CandidateJob::query();

        // Apply search terms
        if ($search) {
            $searchTerms = explode(',', $search);
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $term = trim($term);
                    $q->orWhere('full_name', 'like', "%{$term}%")
                        ->orWhere('gender', 'like', "%{$term}%")
                        ->orWhere('job_interview_status', 'like', "%{$term}%")
                        ->orWhere('whatapp_no', 'like', "%{$term}%")
                        ->orWhere('alternate_contact_no', 'like', "%{$term}%")
                        ->orWhere('mofa_no', 'like', "%{$term}%")
                        ->orWhere('medical_status', 'like', "%{$term}%")
                        ->orWhere('fst_installment_amount', 'like', "%{$term}%")
                        ->orWhere('secnd_installment_amount', 'like', "%{$term}%");
                }
            });
        }

        // Filter by job ID (Ensure it's an array if it's not already)
        if ($job_id) {
            $job_id = is_array($job_id) ? $job_id : [$job_id];
            $query->whereIn('job_id', $job_id)->where('job_interview_status', '!=', 'Not-Interested');
        }

        // Filter by company
        if ($company) {
            $query->where('company_id', $company)->where('job_interview_status', '!=', 'Not-Interested');
        }

        // Filter by interview pipeline status
        if ($int_pipeline) {
            $this->applyInterviewPipelineFilter($query, $int_pipeline);
        }

        // Count statistics
        $count = $this->getJobStatistics($job_id, $company, $search, $interestedType, $interviewId);

        // Check if the user is a "DATA ENTRY OPERATOR" or "RECRUITER"
        if (Auth::user()->hasRole('DATA ENTRY OPERATOR') || Auth::user()->hasRole('RECRUITER')) {
            // Apply filtering for self-assigned interview ID
            if ($interestedType == 'self' && $interviewId) {
                $candidate_jobs = $query->where('interview_id', $interviewId)->orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)->paginate(15);
            } else {
                $candidate_jobs = $query->orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)->paginate(15);
            }

            // Paginate the results, filtering by assigned user ID

        } else {
            // Apply filtering for team-assigned interview ID
            if ($interestedType == 'team' && $interviewId) {
                $candidate_jobs = $query->where('interview_id', $interviewId)->orderBy('id', 'desc')->paginate(15);
            } else {
                $candidate_jobs = $query->orderBy('id', 'desc')->paginate(15);
            }

            // Paginate the results

        }

        // Render the results into a view
        $view = view('jobs.company-filter', compact('candidate_jobs', 'count', 'int_pipeline'))->render();

        // Return a JSON response
        return response()->json([
            'view' => $view
        ]);
    }

    // Helper function to apply interview pipeline filters
    private function applyInterviewPipelineFilter($query, $int_pipeline)
    {
        switch ($int_pipeline) {
            case 'All':
                $query->where(function ($q) {
                    $q->where('job_interview_status', 'Interested');
                })
                    ->whereNull('deployment_date')
                    ->whereNull('total_amount')
                    ->whereNull('visa_receiving_date')
                    ->whereNull('medical_status');
                break;

            case 'Appeared':
                $query->where('job_interview_status', 'Appeared')
                    ->whereNull('deployment_date')
                    ->whereNull('total_amount')
                    ->whereNull('visa_receiving_date')
                    ->whereNull('medical_status');
                break;

            case 'Selection':
                $query->where('job_interview_status', 'Selected')
                    ->whereNull('deployment_date')
                    ->whereNull('total_amount')
                    ->whereNull('visa_receiving_date')
                    ->whereNull('medical_status');
                break;

            case 'Medical':
                $query->whereNotNull('medical_status')
                    ->whereNull('deployment_date')
                    ->whereNull('total_amount')
                    ->whereNull('visa_receiving_date');
                break;

            case 'Document':
                $query->whereNotNull('visa_receiving_date')
                    ->whereNull('deployment_date')
                    ->whereNull('total_amount');
                break;

            case 'Collection':
                $query->whereNotNull('total_amount')
                    ->whereNull('deployment_date');
                break;

            case 'Deployment':
                $query->whereNotNull('deployment_date');
                break;

            default:
                break;
        }
    }


    // Helper function to get job statistics
    private function getJobStatistics($job_id, $company, $search, $interestedType, $interviewId)
    {
        $baseQuery = CandidateJob::query();

        if ($search) {
            $searchTerms = explode(',', $search);
            $baseQuery->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $term = trim($term);
                    $q->orWhere('full_name', 'like', "%{$term}%")
                        ->orWhere('gender', 'like', "%{$term}%")
                        ->orWhere('job_interview_status', 'like', "%{$term}%")
                        ->orWhere('whatapp_no', 'like', "%{$term}%")
                        ->orWhere('alternate_contact_no', 'like', "%{$term}%")
                        ->orWhere('mofa_no', 'like', "%{$term}%")
                        ->orWhere('medical_status', 'like', "%{$term}%")
                        ->orWhere('fst_installment_amount', 'like', "%{$term}%")
                        ->orWhere('secnd_installment_amount', 'like', "%{$term}%");
                }
            });
        }

        if ($job_id) {
            $baseQuery->whereIn('job_id', $job_id);
        }

        if ($company) {
            $baseQuery->where('company_id', $company)->where('job_interview_status', '!=', 'Not-Interested');
        }
        if (Auth::user()->hasRole('DATA ENTRY OPERATOR') || Auth::user()->hasRole('RECRUITER')) {
            if ($interestedType == 'self' && $interviewId) {
                $candidate_jobs = $baseQuery->where('interview_id', $interviewId)->orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)->get();
            } else {
                $candidate_jobs = $baseQuery->orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)->get();
            }
        } else {
            if ($interestedType == 'team' && $interviewId) {
                $candidate_jobs = $baseQuery->where('interview_id', $interviewId)->orderBy('id', 'desc')->get();
            } else {
                $candidate_jobs = $baseQuery->orderBy('id', 'desc')->get();
            }
        }

        // return [
        //     'total_interviews' => $candidate_jobs->whereIn('job_interview_status', ['Interested', 'Selected'])->count(),
        //     'total_selection' => $candidate_jobs->where('job_interview_status', 'Selected')->count(),
        //     'total_medical' => $candidate_jobs->whereNotNull('medical_status')->count(),
        //     'total_doc' => $candidate_jobs->whereNotNull('visa_receiving_date')->count(),
        //     'total_collection' => $candidate_jobs->whereNotNull('total_amount')->count(),
        //     'total_deployment' => $candidate_jobs->whereNotNull('deployment_date')->count(),
        //     'total_appeared' => $candidate_jobs->whereIn('job_interview_status', ['Appeared'])->count(),
        // ];

        $count = [
            'total_interviews' => 0,
            'total_appeared' => 0,
            'total_selection' => 0,
            'total_medical' => 0,
            'total_doc' => 0,
            'total_collection' => 0,
            'total_deployment' => 0,
        ];


        foreach ($candidate_jobs as $key => $candidate) {
            if (
                is_null($candidate->deployment_date) &&
                is_null($candidate->total_amount) &&
                is_null($candidate->visa_receiving_date) &&
                is_null($candidate->medical_status) &&
                ($candidate->job_interview_status != 'Appeared') &&
                ($candidate->job_interview_status != 'Not-Interested') &&
                ($candidate->job_interview_status === 'Interested')
            ) {
                $count['total_interviews']++;
            } elseif (
                is_null($candidate->deployment_date) &&
                is_null($candidate->total_amount) &&
                is_null($candidate->visa_receiving_date) &&
                is_null($candidate->medical_status) &&
                $candidate->job_interview_status === 'Appeared'
            ) {
                $count['total_appeared']++;
            } elseif (
                $candidate->job_interview_status === 'Selected' &&
                is_null($candidate->deployment_date) &&
                is_null($candidate->total_amount) &&
                is_null($candidate->visa_receiving_date) &&
                is_null($candidate->medical_status)
            ) {
                $count['total_selection']++;
            } elseif (
                !is_null($candidate->medical_status) &&
                is_null($candidate->deployment_date) &&
                is_null($candidate->total_amount) &&
                is_null($candidate->visa_receiving_date)
            ) {
                $count['total_medical']++;
            } elseif (
                !is_null($candidate->visa_receiving_date) &&
                is_null($candidate->deployment_date) &&
                is_null($candidate->total_amount)
            ) {
                $count['total_doc']++;
            } elseif (
                !is_null($candidate->total_amount) &&
                is_null($candidate->deployment_date)
            ) {
                $count['total_collection']++;
            } elseif (!is_null($candidate->deployment_date)) {
                $count['total_deployment']++;
            }
        }

        return $count;
    }

    public function candidateDetailsUpdate(Request $request, string $id)
    {

        $request->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'whatapp_no' => 'nullable|regex:/^\+91\d{10}$/',
            'alternate_contact_no' => 'nullable|digits:10',
        ], [
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'whatapp_no.regex' => 'The whatapp no must be +91xxxxxxxxxx format.',
        ]);

        $company_id = Job::where('id', $request->job_title)->first()->company_id;

        $candidate_job_update = CandidateJob::findOrFail($id);
        $candidate_job_update->full_name = $request->full_name;
        $candidate_job_update->email = $request->email;
        $candidate_job_update->gender = $request->gender;
        $candidate_job_update->date_of_birth = $request->dob;
        $candidate_job_update->whatapp_no = $request->whatapp_no;
        $candidate_job_update->alternate_contact_no = $request->alternate_contact_no;
        $candidate_job_update->religion = $request->religion;
        $candidate_job_update->city = $request->city;
        $candidate_job_update->address = $request->address;
        $candidate_job_update->education = $request->education;
        $candidate_job_update->other_education = $request->other_education;
        $candidate_job_update->passport_number = $request->passport_number;
        $candidate_job_update->english_speak = $request->english_speak;
        $candidate_job_update->arabic_speak = $request->arabic_speak;
        $candidate_job_update->job_id = $request->job_title;
        $candidate_job_update->job_location = $request->job_location;
        $candidate_job_update->job_interview_status = $request->interview_status;
        $candidate_job_update->update();

        if ($request->indian_driving_license) {
            // delete old licence
            CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'indian')->delete();

            foreach ($request->indian_driving_license as $key => $value) {
                $candidate_ind_licence = new CandJobLicence();
                $candidate_ind_licence->candidate_job_id = $candidate_job_update->id;
                $candidate_ind_licence->candidate_id = $request->candidate_id;
                $candidate_ind_licence->licence_type = 'indian';
                $candidate_ind_licence->licence_name = $value;
                $candidate_ind_licence->save();
            }
        }

        if ($request->international_driving_license) {
            // delete old licence
            CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'gulf')->delete();

            foreach ($request->international_driving_license as $key => $value) {
                $candidate_gulf_licence = new CandJobLicence();
                $candidate_gulf_licence->candidate_job_id = $candidate_job_update->id;
                $candidate_gulf_licence->candidate_id = $request->candidate_id;
                $candidate_gulf_licence->licence_type = 'gulf';
                $candidate_gulf_licence->licence_name = $value;
                $candidate_gulf_licence->save();
            }
        }

        $jobs = Job::where('status', 'Ongoing')->get();
        $candidate_job = CandidateJob::findOrFail($id);
        $indian_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'indian')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray();
        $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
        // session()->flash('message', 'Candidate details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.candidate-details', ['candidate_job_detail' => $candidate_job, 'indian_driving_license' => $indian_driving_license, 'gulf_driving_license' => $gulf_driving_license, 'candidate_positions' => $candidate_positions, 'jobs' => $jobs])->render()]);

        // session()->flash('message', 'Candidate details updated successfully');
        // return response()->json(['message' => 'Candidate details updated successfully.', 'status' => 'success']);

    }

    public function candidateJobDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'date_of_interview' => 'required|date',
            'date_of_selection' => 'nullable|date',
            'salary' => 'required|numeric',
            'contract_duration' => 'nullable|numeric',
            'food_allowance' => 'nullable|numeric',
        ], [
            'salary.required' => 'The salary field is required.',
            'date_of_interview.required' => 'The date of interview is required.',
        ]);

        $job_details_update = CandidateJob::findOrFail($id);
        $job_details_update->date_of_interview = $request->date_of_interview;
        $job_details_update->date_of_selection = $request->date_of_selection;
        $job_details_update->mode_of_selection = $request->mode_of_selection;
        $job_details_update->interview_location = $request->interview_location;
        $job_details_update->client_remarks = $request->client_remarks;
        $job_details_update->other_remarks = $request->other_remarks;
        $job_details_update->sponsor = $request->sponsor;
        $job_details_update->country = $request->country;
        $job_details_update->salary = $request->salary;
        $job_details_update->food_allowance = $request->food_allowance;
        $job_details_update->contract_duration = $request->contract_duration;

        $job_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate job details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.job-details', ['candidate_job_detail' => $candidate_job])->render()]);
    }

    public function candidateFamilyDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'family_contact_name' => 'required',
            'family_contact_no' => 'required|numeric|digits:10',
        ], [
            'family_contact_name.required' => 'The family contact name is required.',
            'family_contact_no.required' => 'The family contact no is required.',
        ]);

        $family_details_update = CandidateJob::findOrFail($id);
        $family_details_update->family_contact_name = $request->family_contact_name;
        $family_details_update->family_contact_no = $request->family_contact_no;
        $family_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate family details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.family-details', ['candidate_job_detail' => $candidate_job])->render()]);
    }

    public function candidateMedicalDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'medical_approval_date' => 'required|date',
            'medical_application_date' => 'nullable|required_with:medical_status|date',
            'medical_completion_date' => 'nullable|required_with:medical_status|date',
            'medical_expiry_date' => 'nullable|date',
            'medical_status' => 'nullable|required_with:medical_completion_date',
            // if medical_status is REPEAT then medical_repeat_date is required
            'medical_repeat_date' => 'nullable|required_if:medical_status,REPEAT|date',

        ], [
            'medical_application_date.required' => 'The medical apllication date is required.',
            'medical_completion_date.required' => 'The medical completion date is required.',
            'medical_expiry_date.required' => 'The medical expiry date is required.',
            'medical_status.required' => 'The medical status is required.',

        ]);

        $medical_details_update = CandidateJob::findOrFail($id);
        $medical_details_update->medical_application_date = $request->medical_application_date;
        $medical_details_update->medical_approval_date = $request->medical_approval_date;
        $medical_details_update->medical_completion_date = $request->medical_completion_date;
        $medical_details_update->medical_expiry_date = $request->medical_expiry_date;
        $medical_details_update->medical_status = $request->medical_status;
        if ($request->medical_status == 'REPEAT') {
            $medical_details_update->medical_repeat_date = $request->medical_repeat_date ?? null;
        } else {
            $medical_details_update->medical_repeat_date = null;
        }


        $medical_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate medical details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.medical-details', ['candidate_job_detail' => $candidate_job])->render()]);
    }

    public function candidateVisaDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'visa_receiving_date' => 'required|date',
            'visa_issue_date' => 'nullable|date',
            'visa_expiry_date' => 'nullable|date',
            'mofa_no' => 'nullable|string',
            'mofa_date' => 'nullable|date|required_with:mofa_received_date',
            'mofa_received_date' => 'nullable|date|after_or_equal:mofa_date',
            'vfs_applied_date' => 'nullable|date|required_with:vfs_received_date',
            'vfs_received_date' => 'nullable|date|after_or_equal:vfs_applied_date',
        ], [
            'visa_receiving_date.required' => 'The visa receiving date is required.',
            'mofa_date.required_with' => 'The MOFA date is required when the MOFA received date is provided.',
            'mofa_received_date.after_or_equal' => 'The MOFA received date must be equal to or after the MOFA date.',
            'vfs_applied_date.required_with' => 'The VFS applied date is required when the VFS received date is provided.',
            'vfs_received_date.after_or_equal' => 'The VFS received date must be equal to or after the VFS applied date.',
            'mofa_date.date' => 'The MOFA date must be a valid date.',
        ]);



        $visa_details_update = CandidateJob::findOrFail($id);
        $visa_details_update->visa_receiving_date = $request->visa_receiving_date;
        $visa_details_update->visa_issue_date = $request->visa_issue_date;
        $visa_details_update->visa_expiry_date = $request->visa_expiry_date;
        $visa_details_update->mofa_no = $request->mofa_no;
        $visa_details_update->mofa_date = $request->mofa_date;
        $visa_details_update->mofa_received_date = $request->mofa_received_date;
        $visa_details_update->vfs_applied_date = $request->vfs_applied_date;
        $visa_details_update->vfs_received_date = $request->vfs_received_date;
        $visa_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate visa details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.visa-details', ['candidate_job_detail' => $candidate_job])->render()]);
    }

    public function candidateTicketDetailsUpdate(request $request, string $id)
    {
        $request->validate([
            'ticket_booking_date' => 'required|date',
            'ticket_confirmation_date' => 'nullable|date',
            'onboarding_flight_city' => 'nullable',
        ]);

        $ticket_details_update = CandidateJob::findOrFail($id);
        $ticket_details_update->ticket_booking_date = $request->ticket_booking_date;
        $ticket_details_update->ticket_confirmation_date = $request->ticket_confirmation_date;
        $ticket_details_update->onboarding_flight_city = $request->onboarding_flight_city;
        $ticket_details_update->deployment_date = $request->deployment_date;
        $ticket_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        $candidate_refer = Candidate::where('id', $candidate_job->candidate_id)->first() ?? '';
        $job_referral_point = Job::where('id', $candidate_job->job_id)->first() ?? '';
        $referral_amount = ReferralPoint::where('id', $job_referral_point->referral_point_id)->first() ?? '';

        if ($request->deployment_date && $candidate_refer->referred_by_id) {

            $refer_point = new CandidateReferralPoint();
            $refer_point->refer_candidate_id = $candidate_job->candidate_id ?? null;
            $refer_point->referrer_candidate_id = $candidate_refer->referred_by_id ?? null;
            $refer_point->refer_point_id = $job_referral_point->referral_point_id ?? null;
            $refer_point->refer_point = $referral_amount->point ?? null;
            $refer_point->amount = $referral_amount->amount ?? null;
            $refer_point->refer_job_id = $candidate_job->job_id ?? null;
            $refer_point->save();
        }

        // session()->flash('message', 'Candidate ticket details updated successfully');
        return response()->json([
            'view' => view('jobs.update-single-data', compact('candidate_job'))->render(),
            'view1' => view('jobs.ticket-details', ['candidate_job_detail' => $candidate_job])->render(),
            'status' => 'success'
        ]);
    }

    public function candidatePaymentDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            // if fst_installment_amount is not null then fst_installment_date is required
            'fst_installment_amount' => 'required|required_with:fst_installment_date|numeric|gte:0',
            'fst_installment_date' => 'nullable|required_with:fst_installment_amount|date',
            // if secnd_installment_amount is not null then secnd_installment_date is required
            'secnd_installment_amount' => 'nullable|numeric|gte:0',
            'secnd_installment_date' => 'nullable|required_with:secnd_installment_amount|date',
            // if third_installment_amount is not null then third_installment_date is required
            'third_installment_amount' => 'nullable|numeric|gte:0',
            'third_installment_date' => 'nullable|required_with:third_installment_amount|date',
            // if fourth_installment_amount is not null then fourth_installment_date is required
            'fourth_installment_amount' => 'nullable|numeric|gte:0',
            'fourth_installment_date' => 'nullable|required_with:fourth_installment_amount|date',
            // if any of the installment amount is not null then total_amount is required
            'total_amount' => 'nullable|required_with:fst_installment_amount,secnd_installment_amount,third_installment_amount,fourth_installment_amount|numeric',
        ], [
            'fst_installment_amount.required' => 'The first installment amount is required.',
            'fst_installment_date.required' => 'The first installment date is required.',
            'total_amount.required' => 'The total amount is required.',
            'fst_installment_amount.numeric' => 'The first installment amount must be a number.',
            'secnd_installment_amount.numeric' => 'The second installment amount must be a number.',
            'third_installment_amount.numeric' => 'The third installment amount must be a number.',
            'fourth_installment_amount.numeric' => 'The fourth installment amount must be a number.',
            'total_amount.numeric' => 'The total amount must be a number.',
            'fst_installment_date.date' => 'The first installment date must be a date.',
            'secnd_installment_date.date' => 'The second installment date must be a date.',
            'third_installment_date.date' => 'The third installment date must be a date.',
            'fourth_installment_date.date' => 'The fourth installment date must be a date.',
            'fst_installment_amount.required_with' => 'The first installment amount is required.',
            'fst_installment_date.required_with' => 'The first installment date is required.',
            'secnd_installment_amount.required_with' => 'The second installment amount is required.',
            'secnd_installment_date.required_with' => 'The second installment date is required.',
            'third_installment_amount.required_with' => 'The third installment amount is required.',
            'third_installment_date.required_with' => 'The third installment date is required.',
            'fourth_installment_amount.required_with' => 'The fourth installment amount is required.',
            'fourth_installment_date.required_with' => 'The fourth installment date is required.',
            'total_amount.required_with' => 'The total amount is required.',
        ]);

        $payment_details_update = CandidateJob::findOrFail($id);
        $payment_details_update->fst_installment_amount = $request->fst_installment_amount;
        $payment_details_update->fst_installment_date = $request->fst_installment_date;
        $payment_details_update->fst_installment_remarks = $request->fst_installment_remarks;

        $payment_details_update->secnd_installment_amount = $request->secnd_installment_amount;
        $payment_details_update->secnd_installment_date = $request->secnd_installment_date;
        $payment_details_update->secnd_installment_remarks = $request->secnd_installment_remarks;

        $payment_details_update->third_installment_amount = $request->third_installment_amount;
        $payment_details_update->third_installment_date = $request->third_installment_date;
        $payment_details_update->third_installment_remarks = $request->third_installment_remarks;

        $payment_details_update->fourth_installment_amount = $request->fourth_installment_amount;
        $payment_details_update->fourth_installment_date = $request->fourth_installment_date;
        $payment_details_update->fourth_installment_remarks = $request->fourth_installment_remarks;

        $payment_details_update->total_amount = $request->total_amount;
        $payment_details_update->due_amount = $request->due_amount;
        $payment_details_update->discount = $request->discount;

        // $payment_details_update->job_status = $request->job_status;
        $payment_details_update->update();


        $candidate_job = CandidateJob::findOrFail($id);


        $candidate_job_detail = CandidateJob::findOrFail($id);

        // session()->flash('message', 'Candidate payment details updated successfully');
        // return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'view1' => view('jobs.payment-details', compact('candidate_job_detail'))->render(), 'status' => 'success']);
    }

    public function candidateDocumentDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'courrier_sent_date' => 'required|date',
            'courrier_received_date' => 'nullable|date|after_or_equal:courrier_sent_date',
        ], [
            'courrier_sent_date.required' => 'The courrier sent date is required.',
            'courrier_sent_date.date' => 'The courrier sent date must be a valid date.',
            'courrier_received_date.date' => 'The courrier received date must be a valid date.',
        ]);

        $document_details_update = CandidateJob::findOrFail($id);
        $document_details_update->courrier_sent_date = $request->courrier_sent_date;
        $document_details_update->courrier_received_date = $request->courrier_received_date;
        $document_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate document details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'view1' => view('jobs.document-details', ['candidate_job_detail' => $candidate_job])->render(), 'status' => 'success']);
    }

    public function sendJobSms(Request $request)
    {
        $candidate_ids = $request->candidate_ids;
        $message = $request->message;

        $numbers = [];
        foreach ($candidate_ids as $candidateId) {
            $candidate = Candidate::find($candidateId);

            if ($candidate && $candidate->contact_no) {
                $numbers[] = $candidate->contact_no;
            }
        }

        if (!empty($numbers)) {
            $response = $this->textlocalService->sendSms($numbers, $message);

            if (isset($response['status']) && $response['status'] == 'success') {
                session()->flash('message', 'Messages are being sent.');
                return response()->json(['status' => true, 'message' => 'Messages sent successfully.']);
            } else {
                return response()->json(['status' => false, 'message' => $response['errors'] ?? 'Failed to send messages.']);
            }
        }

        return response()->json(['status' => false, 'message' => 'No valid phone numbers found.']);
    }


    public function sendJobWhatsapp(Request $request)
    {
        $job_ids = $request->job_ids;
        $message = $request->message;

        foreach ($job_ids as $job_id) {
            $candidate = CandidateJob::where('id', $job_id)->first();

            if ($candidate && $candidate->whatapp_no) {
                SendJobWhatsapp::dispatch($candidate, $message);
            }
        }

        session()->flash('message', 'Messages are being sent.');
        return response()->json(['status' => 'Messages are being sent.']);
    }

    public function downloadSample()
    {
        $path = public_path('sample_excel/jobs-example.xlsx');
        return response()->download($path);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        Excel::import(new CandidateJobImport(), $request->file('file')->store('temp'));
        session()->flash('message', 'Job imported successfully');
        return redirect()->back()->with('message', 'Job imported successfully');
    }

    public function export(Request $request)
    {
        if (Auth::user()->can('Export Candidate')) {
            $request->validate([
                'start_date' => 'required|date|before_or_equal:end_date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            try {
                return Excel::download(
                    new CandidateJobExport($request->start_date, $request->end_date),
                    'candidate-export-' . now()->format('Y-m-d') . '.xlsx'
                );
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


}
