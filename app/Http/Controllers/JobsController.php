<?php

namespace App\Http\Controllers;

use App\Events\CallCandidateEndEvent;
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
                $candidate_jobs = CandidateJob::orderBy('id', 'desc')->where('assign_by_id', Auth::user()->id)->where('job_interview_status','!=','Not-Interested')->paginate(15);
            } else {

                $candidate_jobs = CandidateJob::orderBy('id', 'desc')->where('job_interview_status','!=','Not-Interested')->paginate(15);
            }

            $companies = Company::orderBy('company_name', 'asc')->with('jobs')->get();
            $count['total_interviews'] = CandidateJob::where('job_interview_status', 'Interested')->count();
            $count['total_selection'] = CandidateJob::where('job_interview_status', 'Selected')->count();
            $count['total_medical'] = CandidateJob::where('medical_status', '!=', null)->count();
            $count['total_doc'] = CandidateJob::where('visa_receiving_date', '!=', null)->count();
            $count['total_collection'] = CandidateJob::where('total_amount', '!=', null)->count();
            $count['total_deployment'] =  CandidateJob::where('deployment_date', '!=', null)->count();
            return view('jobs.list')->with(compact('candidate_jobs', 'companies', 'count'));
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
        $users = User::where('is_active', 1)->get();
        $candidate_job_detail = CandidateJob::findOrFail($id);
        $candidate = Candidate::findOrFail($candidate_job_detail->candidate_id);
        $jobs = Job::where('status', 'Ongoing')->get();
        $indian_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'indian')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandJobLicence::where('candidate_job_id', $id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray();
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

    public function candidatejobFilter(Request $request)
    {
        // Retrieve request parameters
        $search = $request->search;
        $job_id = $request->job_id;
        $company = $request->company;
        $int_pipeline = $request->int_pipeline;

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

        // Filter by job ID
        if ($job_id) {
            $query->whereIn('job_id', $job_id)->where('job_interview_status','!=','Not-Interested');
        }

        // Filter by company
        if ($company) {
            $query->where('company_id', $company)->where('job_interview_status','!=','Not-Interested');
        }

        // Filter by interview pipeline status
        if ($int_pipeline) {
            $this->applyInterviewPipelineFilter($query, $int_pipeline);
        }

        // Count statistics
        $count = $this->getJobStatistics($job_id, $company, $search);

        // Paginate the results
        $candidate_jobs = $query->paginate(15);

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
                $query->where('job_interview_status','Interested');
                break;
            case 'Selection':
                $query->where('job_interview_status', 'Selected');
                break;
            case 'Medical':
                $query->whereNotNull('medical_status');
                break;
            case 'Document':
                $query->whereNotNull('visa_receiving_date');
                break;
            case 'Collection':
                $query->whereNotNull('total_amount');
                break;
            case 'Deployment':
                $query->whereNotNull('deployment_date');
                break;
            default:
                break;
        }
    }

    // Helper function to get job statistics
    private function getJobStatistics($job_id, $company, $search)
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
            $baseQuery->where('company_id', $company)->where('job_interview_status','!=','Not-Interested');
        }

        $candidate_jobs = $baseQuery->get();

        return [
            'total_interviews' => $candidate_jobs->where('job_interview_status','Interested')->count(),
            'total_selection' => $candidate_jobs->where('job_interview_status', 'Selected')->count(),
            'total_medical' => $candidate_jobs->where('medical_status', '!=', null)->count(),
            'total_doc' => $candidate_jobs->where('visa_receiving_date', '!=', null)->count(),
            'total_collection' => $candidate_jobs->where('total_amount', '!=', null)->count(),
            'total_deployment' => $candidate_jobs->whereNotNull('deployment_date')->count()
        ];
    }

    public function candidateDetailsUpdate(Request $request, string $id)
    {

        $request->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
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
        $candidate_job_update->job_position = $request->job_position;
        $candidate_job_update->job_location = $request->job_location;
        $candidate_job_update->company_id = $company_id;
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

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);

        // session()->flash('message', 'Candidate details updated successfully');
        // return response()->json(['message' => 'Candidate details updated successfully.', 'status' => 'success']);

    }

    public function candidateJobDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'date_of_interview' => 'required',
            'salary' => 'required|numeric',
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
        $job_details_update->mofa_no = $request->mofa_no;
        $job_details_update->mofa_date = $request->mofa_date;
        $job_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate job details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
    }

    public function candidateFamilyDetailsUpdate(Request $request, string $id)
    {

        $family_details_update = CandidateJob::findOrFail($id);
        $family_details_update->family_contact_name = $request->family_contact_name;
        $family_details_update->family_contact_no = $request->family_contact_no;
        $family_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate family details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
    }

    public function candidateMedicalDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'medical_application_date' => 'required',
            'medical_completion_date' => 'nullable|required_with:medical_status',
            'medical_status' => 'nullable|required_with:medical_completion_date',
        ], [
            'medical_application_date.required' => 'The medical apllication date is required.',
            'medical_completion_date.required' => 'The medical completion date is required.',
            'medical_status.required' => 'The medical status is required.',
        ]);

        $medical_details_update = CandidateJob::findOrFail($id);
        $medical_details_update->medical_application_date = $request->medical_application_date;
        $medical_details_update->medical_completion_date = $request->medical_completion_date;
        $medical_details_update->medical_status = $request->medical_status;
        $medical_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate medical details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
    }

    public function candidateVisaDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'visa_receiving_date' => 'required',
        ], [
            'visa_receiving_date.required' => 'The visa receiving date is required.',
        ]);

        $visa_details_update = CandidateJob::findOrFail($id);
        $visa_details_update->visa_receiving_date = $request->visa_receiving_date;
        $visa_details_update->visa_issue_date = $request->visa_issue_date;
        $visa_details_update->visa_expiry_date = $request->visa_expiry_date;
        $visa_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate visa details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
    }

    public function candidateTicketDetailsUpdate(request $request, string $id)
    {
        $request->validate([
            'ticket_booking_date' => 'required',
        ]);

        $ticket_details_update = CandidateJob::findOrFail($id);
        $ticket_details_update->ticket_booking_date = $request->ticket_booking_date;
        $ticket_details_update->ticket_confirmation_date = $request->ticket_confirmation_date;
        $ticket_details_update->update();

        $candidate_job = CandidateJob::findOrFail($id);
        // session()->flash('message', 'Candidate ticket details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
    }

    public function candidatePaymentDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            // if fst_installment_amount is not null then fst_installment_date is required
            'fst_installment_amount' => 'nullable|required_with:fst_installment_date|numeric',
            'fst_installment_date' => 'nullable|required_with:fst_installment_amount',
            // if secnd_installment_amount is not null then secnd_installment_date is required
            'secnd_installment_amount' => 'nullable|required_with:secnd_installment_date|numeric',
            'secnd_installment_date' => 'nullable|required_with:secnd_installment_amount',
            // if third_installment_amount is not null then third_installment_date is required
            'third_installment_amount' => 'nullable|required_with:third_installment_date|numeric',
            'third_installment_date' => 'nullable|required_with:third_installment_amount',
            // if fourth_installment_amount is not null then fourth_installment_date is required
            'fourth_installment_amount' => 'nullable|required_with:fourth_installment_date|numeric',
            'fourth_installment_date' => 'nullable|required_with:fourth_installment_amount',
            // if any of the installment amount is not null then total_amount is required
            'total_amount' => 'nullable|required_with:fst_installment_amount,secnd_installment_amount,third_installment_amount,fourth_installment_amount|numeric',
        ]);

        $payment_details_update = CandidateJob::findOrFail($id);
        $payment_details_update->fst_installment_amount = $request->fst_installment_amount;
        $payment_details_update->fst_installment_date = $request->fst_installment_date;
        $payment_details_update->secnd_installment_amount = $request->secnd_installment_amount;
        $payment_details_update->secnd_installment_date = $request->secnd_installment_date;
        $payment_details_update->third_installment_amount = $request->third_installment_amount;
        $payment_details_update->third_installment_date = $request->third_installment_date;
        $payment_details_update->fourth_installment_amount = $request->fourth_installment_amount;
        $payment_details_update->fourth_installment_date = $request->fourth_installment_date;
        $payment_details_update->total_amount = $request->total_amount;
        $payment_details_update->deployment_date = $request->deployment_date;
        $payment_details_update->job_status = $request->job_status;
        $payment_details_update->update();


        $candidate_job = CandidateJob::findOrFail($id);
        $candidate_refer = Candidate::where('id',$candidate_job->candidate_id)->first() ?? '';
        $job_referral_point = Job::where('id',$candidate_job->job_id)->first() ?? '';
        $referral_amount = ReferralPoint::where('id',$job_referral_point->referral_point_id)->first() ?? '';

        if($request->deployment_date && $candidate_refer->referred_by_id)
        {
                
                $refer_point = new CandidateReferralPoint();
                $refer_point->refer_candidate_id = $candidate_job->candidate_id ?? null;
                $refer_point->referrer_candidate_id = $candidate_refer->referred_by_id ?? null;
                $refer_point->refer_point_id = $job_referral_point->referral_point_id ?? null;
                $refer_point->amount = $referral_amount->amount ?? null;
                $refer_point->refer_job_id = $candidate_job->job_id ?? null;
                $refer_point->save(); 
        }

        // session()->flash('message', 'Candidate payment details updated successfully');
        return response()->json(['view' => view('jobs.update-single-data', compact('candidate_job'))->render(), 'status' => 'success']);
    }
}
