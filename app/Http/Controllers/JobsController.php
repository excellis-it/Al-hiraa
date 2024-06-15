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
use App\Models\CandJobLicence;
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

        return response()->json(['view' => view('jobs.edit', compact('candidate','jobs','candidate_job_detail','users', 'companies', 'candidate_positions', 'assign_job', 'edit', 'indian_driving_license', 'gulf_driving_license'))->render(), 'status' => 'success']);
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

    public function candidateDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
        ], [
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'whatapp_no.regex' => 'The whatapp no must be +91xxxxxxxxxx format.',
        ]);

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
        $candidate_job_update->job_title = $request->job_title;
        $candidate_job_update->job_position = $request->job_position;
        $candidate_job_update->job_location = $request->job_location;
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

        // session()->flash('message', 'Candidate details updated successfully');
        return response()->json(['message' => 'Candidate details updated successfully.', 'status' => 'success']);

    }

    public function candidateJobDetailsUpdate(Request $request, string $id )
    {
        $request->validate([
            'date_of_interview' => 'required',
            'date_of_selection' => 'required',
            'salary' => 'required',
        ], [
            'salary.required' => 'The salary field is required.',
            'date_of_interview.required' => 'The date of interview is required.',
            'date_of_selection.required' => 'The date of selection is required.',   
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

        return response()->json(['message' => 'Candidate job details updated successfully.', 'status' => 'success']);
    }

    public function candidateFamilyDetailsUpdate(Request $request, string $id)
    {
        $request->validate([
            'family_contact_name' => 'required',
            'family_contact_no' => 'required',
        ], [
            'family_contact_name.required' => 'The family contact name is required.',
            'family_contact_no.required' => 'The family contact no is required.',
        ]);

        $family_details_update = CandidateJob::findOrFail($id);
        $family_details_update->family_contact_name = $request->family_contact_name;
        $family_details_update->family_contact_no = $request->family_contact_no;
        $family_details_update->update();

        return response()->json(['message' => 'Candidate family details updated successfully.', 'status' => 'success']);
    }

    public function candidateMedicalDetailsUpdate(Request $request , string $id)
    {
        $request->validate([
            'medical_application_date' => 'required',
            'medical_completion_date' => 'required',
        ], [
            'medical_application_date.required' => 'The medical apllication date is required.',
            'medical_completion_date.required' => 'The medical completion date is required.',
        ]);

        $medical_details_update = CandidateJob::findOrFail($id);
        $medical_details_update->medical_application_date = $request->medical_application_date;
        $medical_details_update->medical_completion_date = $request->medical_completion_date;
        $medical_details_update->medical_status = $request->medical_status;
        $medical_details_update->update();

        return response()->json(['message' => 'Candidate medical details updated successfully.', 'status' => 'success']);

    }

    public function candidateVisaDetailsUpdate(Request $request , string $id)
    {
        $request->validate([
            'visa_receiving_date' => 'required',
            'visa_issue_date' => 'required',
            'visa_expiry_date' => 'required',
        ], [
            'visa_receiving_date.required' => 'The visa receiving date is required.',
            'visa_issue_date.required' => 'The visa issue date is required.',
            'visa_expiry_date.required' => 'The visa expiry date is required.',
        ]);

        $visa_details_update = CandidateJob::findOrFail($id);
        $visa_details_update->visa_receiving_date = $request->visa_receiving_date;
        $visa_details_update->visa_issue_date = $request->visa_issue_date;
        $visa_details_update->visa_expiry_date = $request->visa_expiry_date;
        $visa_details_update->update();

        return response()->json(['message' => 'Candidate visa details updated successfully.', 'status' => 'success']);
    }

    public function candidateTicketDetailsUpdate(request $request, string $id)
    {
        $request->validate([
            'ticket_booking_date' => 'required',
            'ticket_confirmation_date' => 'required',
        ], [
            'ticket_booking_date.required' => 'The ticket booking date is required.',
            'ticket_confirmation_date.required' => 'The ticket confirmation date is required.',
        ]);

        $ticket_details_update = CandidateJob::findOrFail($id);
        $ticket_details_update->ticket_booking_date = $request->ticket_booking_date;
        $ticket_details_update->ticket_confirmation_date = $request->ticket_confirmation_date;
        $ticket_details_update->update();

        return response()->json(['message' => 'Candidate ticket details updated successfully.', 'status' => 'success']);
    }

    public function candidatePaymentDetailsUpdate(Request $request, string $id)
    {
        // $request->validate([
        //     'fst_installment_amount' => 'required',
        //     'fst_installment_date' => 'required',
        // ], [
        //     'fst_installment_amount.required' => 'The first installment amount is required.',
        //     'fst_installment_date.required' => 'The first installment date is required.',
        // ]);

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

        return response()->json(['message' => 'Candidate payment details updated successfully.', 'status' => 'success']);
    }


  
}
