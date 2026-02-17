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
use App\Models\Interview;
use App\Models\Job;
use App\Models\CandidateJob;
use App\Models\User;
use App\Models\CandJobLicence;
use App\Models\Associate;
use App\Models\ReferralPoint;
use App\Models\CandidateReferralPoint;
use App\Services\TextlocalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
        $interviewId = $request->input('interview_id'); // Interview ID

        $medicalType = $request->input('medical_type'); // e.g., 'FIT', 'UNFIT'
        $companyId = $request->input('company_id'); // selected company

        if (!Auth::user()->can('Manage Job')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $user = Auth::user();
        $candidate_jobs = CandidateJob::orderBy('id', 'desc')->where('job_interview_status', '!=', 'Not-Interested');
        $candidates = CandidateJob::orderBy('id', 'desc')->where('job_interview_status', '!=', 'Not-Interested');

        // Role-based filtering
        if ($user->hasRole('DATA ENTRY OPERATOR') || $user->hasRole('RECRUITER')) {
            $candidate_jobs->where('assign_by_id', $user->id);
            $candidates->where('assign_by_id', $user->id);

            if ($interestedType === 'self' && $interviewId) {
                $candidate_jobs->where('interview_id', $interviewId);
                $candidates->where('interview_id', $interviewId);
            }

            $candidate_jobs->whereNull('medical_status')
                ->whereNull('visa_receiving_date')
                ->whereNull('total_amount')
                ->whereNull('deployment_date');

            $candidates->whereNull('medical_status')
                ->whereNull('visa_receiving_date')
                ->whereNull('total_amount')
                ->whereNull('deployment_date');
        } elseif ($user->hasRole('PROCESS MANAGER')) {

            $candidate_jobs->where(function ($q) {
                $q->where('job_interview_status', 'Selected')->orWhereNotNull('medical_status')
                    ->orWhereNotNull('visa_receiving_date')
                    ->orWhereNotNull('total_amount')
                    ->orWhereNotNull('deployment_date');
            });

            $candidates->where(function ($q) {
                $q->where('job_interview_status', 'Selected')->orWhereNotNull('medical_status')
                    ->orWhereNotNull('visa_receiving_date')
                    ->orWhereNotNull('total_amount')
                    ->orWhereNotNull('deployment_date');
            });

            if ($interestedType === 'team' && $interviewId) {
                $candidate_jobs->where('interview_id', $interviewId);
                $candidates->where('interview_id', $interviewId);
            }
            if ($medicalType && $companyId) {
                $candidate_jobs->where('medical_status', $medicalType)->where('company_id', $companyId);
                $candidates->where('medical_status', $medicalType)->where('company_id', $companyId);
            }
        } else {
            // Other roles
            if ($interestedType === 'team' && $interviewId) {
                $candidate_jobs->where('interview_id', $interviewId);
                $candidates->where('interview_id', $interviewId);
            }

            if ($medicalType && $companyId) {
                $candidate_jobs->where('medical_status', $medicalType)->where('company_id', $companyId);
                $candidates->where('medical_status', $medicalType)->where('company_id', $companyId);
            }
        }

        $candidate_jobs = $candidate_jobs->paginate(15);
        $candidates = $candidates->get();

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

        // Loop through candidates to calculate stats
        foreach ($candidates as $candidate) {
            if (
                is_null($candidate->deployment_date) &&
                is_null($candidate->total_amount) &&
                is_null($candidate->visa_receiving_date) &&
                is_null($candidate->medical_status) &&
                $candidate->job_interview_status === 'Interested'
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

        $recent_interviews = Interview::with(['company', 'job.candidatePosition'])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') >= ?", [now()->subDays(30)->format('Y-m-d')])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') <= ?", [now()->format('Y-m-d')])
            ->orderBy('id', 'desc')
            ->get();

        return view('jobs.list', compact('candidate_jobs', 'companies', 'count', 'recent_interviews'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->can('Create Job')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $recent_interviews = Interview::with(['company', 'job.candidatePosition'])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') >= ?", [now()->subDays(30)->format('Y-m-d')])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') <= ?", [now()->format('Y-m-d')])
            ->orderBy('id', 'desc')
            ->get();

        $associates = Associate::orderBy('name', 'asc')->get();

        return view('jobs.create', compact('recent_interviews', 'associates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'job_id' => 'required|exists:jobs,id',
            'interview_id' => 'required|exists:interviews,id',
            'full_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'dob' => 'required|date|before:today',
            'passport_expiry' => 'required|date|after:today',
            'date_of_selection' => 'required|date',
            'whatapp_no' => ['required', 'regex:/^\+91[6-9]\d{9}$/'],

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $interview = Interview::with(['company', 'job'])->findOrFail($request->interview_id);

        $exists = CandidateJob::where('passport_number', $request->passport_number)
            ->where('job_id', $interview->job_id)
            ->where('interview_id', $interview->id)
            ->exists();

        if ($exists) {
            return response()->json(['status' => 'error', 'message' => 'Candidate already exists for this job and interview.']);
        }

        DB::beginTransaction();
        try {
            // Assign Job Logic
            $assign_job = new AssignJob();
            $assign_job->job_id = $interview->job_id;
            $assign_job->company_id = $interview->company_id;
            $assign_job->interview_id = $interview->id;
            $assign_job->user_id = Auth::id();
            $assign_job->interview_status = 'Interested';
            $assign_job->save();

            // Candidate Job Logic
            $candidate_job = new CandidateJob();
            $candidate_job->assign_by_id = Auth::id();
            $candidate_job->assign_job_id = $assign_job->id;
            $candidate_job->full_name = $request->full_name;
            $candidate_job->passport_number = $request->passport_number;
            $candidate_job->contact_no = $request->contact_no;
            $candidate_job->gender = $request->gender;
            $candidate_job->date_of_birth = $request->dob;
            $candidate_job->passport_expiry = $request->passport_expiry;
            $candidate_job->whatapp_no = $request->whatapp_no;
            $candidate_job->email = $request->email;
            $candidate_job->religion = $request->religion;
            $candidate_job->address = $request->address;
            $candidate_job->ecr_type = $request->ecr_type;
            $candidate_job->date_of_selection = $request->date_of_selection; // Add Selection Date

            // Associate logic
            if ($request->associate_id) {
                $candidate_job->associate_id = $request->associate_id;
                $serviceCharge = $interview->job->associate_charge ?? null;
            } else {
                $serviceCharge = $interview->job->service_charge ?? null;
            }

            $candidate_job->due_amount = $serviceCharge;
            $candidate_job->job_service_charge = $serviceCharge;

            $candidate_job->job_id = $interview->job_id;
            $candidate_job->company_id = $interview->company_id;
            $candidate_job->interview_id = $interview->id;

            $candidate_job->job_position = $interview->job->candidate_position_id ?? null;
            $candidate_job->job_location = $interview->job->address ?? null;

            $candidate_job->food_allowance = $interview->job->benifits ?? null;
            $candidate_job->contract_duration = $interview->job->contract ?? null;
            $candidate_job->salary = $interview->job->salary ?? null;

            $candidate_job->date_of_interview = $interview->interview_start_date ?? null;
            $candidate_job->interview_location = $interview->interview_location ?? null;

            $candidate_job->job_interview_status = 'Selected';

            $candidate_job->vendor_id = $interview->job->vendor_id ?? null;
            if ($interview->job->vendor_id) {
                $vendor = User::find($interview->job->vendor_id);
                $candidate_job->vendor_service_charge = $vendor->vendor_service_charge ?? null;
            }

            $candidate_job->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Candidate Job created successfully.', 'redirect_url' => route('jobs.index')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Error creating candidate job: ' . $e->getMessage()]);
        }
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
        $users = User::where('is_active', 1)->get();
        $candidate_job_detail = CandidateJob::findOrFail($id);

        $jobs = Job::where('status', 'Ongoing')->get();
        $indian_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'indian')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray();
        $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
        $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();
        $associates = Associate::orderBy('name', 'asc')->get();
        $edit = true;


        return response()->json(['view' => view('jobs.edit', compact('jobs', 'candidate_job_detail', 'users', 'companies', 'candidate_positions', 'edit', 'indian_driving_license', 'gulf_driving_license', 'associates'))->render(), 'status' => 'success']);
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
        $medicalType = $request->input('medical_type'); // e.g., 'FIT', 'UNFIT'
        $companyId = $request->input('company_id'); // selected company


        // Initialize query
        $query = CandidateJob::query();

        // Apply search terms
        if ($search) {
            $searchTerms = explode(',', $search);
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $term = trim($term);

                    $q->where(function ($subQuery) use ($term) {
                        $subQuery->orWhere('full_name', 'like', "%{$term}%")
                            ->orWhere('gender', 'like', "%{$term}%")
                            ->orWhere('job_interview_status', 'like', "%{$term}%")
                            ->orWhere('whatapp_no', 'like', "%{$term}%")
                            ->orWhere('alternate_contact_no', 'like', "%{$term}%")
                            ->orWhere('mofa_no', 'like', "%{$term}%")
                            ->orWhere('medical_status', 'like', "%{$term}%")
                            ->orWhere('fst_installment_amount', 'like', "%{$term}%")
                            ->orWhere('secnd_installment_amount', 'like', "%{$term}%")
                            ->orWhereHas('company', function ($q) use ($term) {
                                $q->where('company_name', 'like', "%{$term}%");
                            })
                            ->orWhereHas('associate', function ($q) use ($term) {
                                $q->where('name', 'like', "%{$term}%");
                            })
                            ->orWhereHas('associate', function ($q) use ($term) {
                                $q->where('phone_number', 'like', "%{$term}%");
                            });
                    });
                }
            });
        }

        if (Auth::user()->hasRole('DATA ENTRY OPERATOR') || Auth::user()->hasRole('RECRUITER')) {
            $query->whereNull('medical_status')
                ->whereNull('visa_receiving_date')
                ->whereNull('total_amount')
                ->whereNull('deployment_date');
        } elseif (Auth::user()->hasRole('PROCESS MANAGER')) {
            $query->where(function ($q) {
                $q->where('job_interview_status', 'Selected')->orWhereNotNull('medical_status')
                    ->orWhereNotNull('visa_receiving_date')
                    ->orWhereNotNull('total_amount')
                    ->orWhereNotNull('deployment_date');
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
        $count = $this->getJobStatistics($job_id, $company, $search, $interestedType, $interviewId, $medicalType, $companyId);

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
            if ($medicalType && $companyId) {
                $candidate_jobs = $query->where('medical_status', $medicalType)->where('company_id', $companyId)->orderBy('id', 'desc')->paginate(15);
            } elseif ($interestedType == 'team' && $interviewId) {
                $candidate_jobs = $query->where('interview_id', $interviewId)->orderBy('id', 'desc')->paginate(15);
            } else {
                $candidate_jobs = $query->orderBy('id', 'desc')->paginate(15);
            }
        }

        // Render the results into a view
        $recent_interviews = Interview::with(['company', 'job.candidatePosition'])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') >= ?", [now()->subDays(30)->format('Y-m-d')])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') <= ?", [now()->format('Y-m-d')])
            ->orderBy('id', 'desc')
            ->get();

        $view = view('jobs.company-filter', compact('candidate_jobs', 'count', 'int_pipeline', 'recent_interviews'))->render();

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
    private function getJobStatistics($job_id, $company, $search, $interestedType, $interviewId, $medicalType, $companyId)
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
                        ->orWhere('secnd_installment_amount', 'like', "%{$term}%")->orWhereHas('company', function ($q) use ($term) {
                            $q->where('company_name', 'like', "%{$term}%");
                        })
                        ->orWhereHas('associate', function ($q) use ($term) {
                            $q->where('name', 'like', "%{$term}%");
                        })
                        ->orWhereHas('associate', function ($q) use ($term) {
                            $q->where('phone_number', 'like', "%{$term}%");
                        });
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
            } elseif ($medicalType && $companyId) {
                $candidate_jobs = $baseQuery->where('medical_status', $medicalType)->where('company_id', $companyId)->orderBy('id', 'desc')->get();
            } {
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
            'dob' => 'required|date|before:today',
            'passport_number' => 'required|regex:/^[A-Za-z]\d{7}$/',
            'whatapp_no' => 'nullable',
            'contact_no' => 'nullable|digits:10',
            'alternate_contact_no' => 'nullable|digits:10',
            'email' => 'nullable|email',
        ], [
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'passport_number.required' => 'The passport number field is required.',
            'passport_number.regex' => 'The passport number must be valid (e.g., A1234567).',
            'contact_no.digits' => 'The contact no must be 10 digits.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'email.email' => 'The email must be a valid email address.',
        ]);

        $candidate_job = CandidateJob::findOrFail($id);
        if ($candidate_job->associate_id == null && $request->associate_id != null) {
            $candidate_job->job_service_charge = $candidate_job->jobTitle->associate_charge;
            //calculate the due amount
            $candidate_job->due_amount = $candidate_job->job_service_charge - $candidate_job->total_amount;
        }
        $candidate_job->full_name = $request->full_name;
        $candidate_job->email = $request->email;
        $candidate_job->gender = $request->gender;
        $candidate_job->date_of_birth = $request->dob;
        $candidate_job->passport_number = $request->passport_number;
        $candidate_job->passport_expiry = $request->passport_expiry;
        $candidate_job->ecr_type = $request->ecr_type;
        $candidate_job->contact_no = $request->contact_no;
        $candidate_job->whatapp_no = $request->whatapp_no;
        $candidate_job->alternate_contact_no = $request->alternate_contact_no;
        $candidate_job->associate_id = $request->associate_id;
        $candidate_job->address = $request->address;
        $candidate_job->religion = $request->religion;
        $candidate_job->update();

        $associates = Associate::orderBy('name', 'asc')->get();

        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.candidate-details', ['candidate_job_detail' => $candidate_job, 'associates' => $associates])->render()]);
    }

    public function candidateJobDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'date_of_selection' => 'required|date',
            'date_of_interview' => 'required|date',
            'salary' => 'nullable|numeric',
            'contract_duration' => 'nullable|numeric',
            'food_allowance' => 'nullable',
        ], [
            'salary.required' => 'The salary field is required.',
            'date_of_selection.required' => 'The date of selection field is required.',
            'date_of_interview.required' => 'The date of interview field is required.',
        ]);

        $job_details_update = CandidateJob::findOrFail($id);
        $job_details_update->date_of_selection = $request->date_of_selection;
        $job_details_update->date_of_interview = $request->date_of_interview;
        $job_details_update->mode_of_selection = $request->mode_of_selection;
        $job_details_update->client_remarks = $request->client_remarks;
        $job_details_update->other_remarks = $request->other_remarks;
        $job_details_update->sponsor = $request->sponsor;
        $job_details_update->country = $request->country;
        $job_details_update->salary = $request->salary;
        $job_details_update->food_allowance = $request->food_allowance;
        $job_details_update->contract_duration = $request->contract_duration;

        $job_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        $jobs = Job::where('status', 'Ongoing')->get();
        $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();

        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success', 'view1' => view('jobs.job-details', ['candidate_job_detail' => $candidate_job, 'jobs' => $jobs, 'companies' => $companies])->render()]);
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
        if ($request->deployment_date) {

            if ($ticket_details_update->due_amount != null) {
                // dd($ticket_details_update->due_amount );
                if ($ticket_details_update->due_amount <= 0) {
                    $ticket_details_update->deployment_date = $request->deployment_date;
                } else {
                    return response()->json(['status' => false, 'message' => 'Deployment date should be provided when due amount is zero.']);
                }
            } else {
                // dd($ticket_details_update->due_amount );
                // show error message
                return response()->json(['status' => false, 'message' => 'Due amount not null.']);
            }
        }


        $ticket_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        $candidate_refer = Candidate::where('passport_number', $candidate_job->passport_number)->first() ?? '';
        $job_referral_point = Job::where('id', $candidate_job->job_id)->first() ?? '';
        $referral_amount = ReferralPoint::where('id', $job_referral_point->referral_point_id)->first() ?? '';
        // dd($candidate_refer);
        if ($candidate_refer && $request->deployment_date && $candidate_refer->referred_by_id) {
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
            'status' => true
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
            // Optional: validate date range only if no specific IDs are provided
            if (!$request->has('candidate_ids')) {
                // $request->validate([
                //     'start_date' => 'nullable|date|before_or_equal:end_date',
                //     'end_date' => 'nullable|date|after_or_equal:start_date',
                // ]);
            }

            try {
                $filters = $request->all();
                $fileName = 'candidate-export-' . now()->format('Y-m-d') . '.csv';

                return Excel::download(
                    new CandidateJobExport($filters),
                    $fileName,
                    \Maatwebsite\Excel\Excel::CSV
                );
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getCompanyJobsAJAX($company_id)
    {
        $jobs = Job::where('company_id', $company_id)->where('status', 'Ongoing')->whereHas('interviews', function ($query) {
            $query->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') >= ?", [now()->subDays(30)->format('Y-m-d')]);
            $query->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') <= ?", [now()->format('Y-m-d')]);
        })->get();
        return response()->json(['jobs' => $jobs, 'status' => 'success']);
    }

    public function getJobInterviewsAJAX($job_id)
    {
        $interviews = Interview::where('job_id', $job_id)
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') >= ?", [now()->subDays(30)->format('Y-m-d')])
            ->whereRaw("STR_TO_DATE(interview_start_date, '%d-%m-%Y') <= ?", [now()->format('Y-m-d')])
            ->get();
        return response()->json(['interviews' => $interviews, 'status' => 'success']);
    }

    public function getInterviewDataAJAX($interview_id)
    {
        $interview = Interview::with('job')->find($interview_id);
        if ($interview) {
            return response()->json([
                'status' => 'success',
                'salary' => $interview->job->salary ?? '',
                'food_allowance' => $interview->job->benifits ?? '',
                'contract_duration' => $interview->job->contract ?? '',
                'service_charge' => $interview->job->service_charge ?? '',
                'associate_charge' => $interview->job->associate_charge ?? '',
            ]);
        }
        return response()->json(['status' => 'error']);
    }
}
