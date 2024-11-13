<?php

namespace App\Imports;

use App\Models\AssignJob;
use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\CandidateReferralPoint;
use App\Models\CandJobLicence;
use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\ReferralPoint;
use App\Models\User;
use App\Rules\CompanyInterviewExists;
use App\Rules\CompanyNameJobExists;
use App\Rules\CompanyNameLocationExists;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CandidateJobImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        // interview_start_date	interview_end_date	date_of_interview	date_of_selection	mode_of_selection	interview_location	client_remarks	sponsor	country	salary	food_allowance	mofa_date	vfs_applied_date	vfs_received_date	mofa_received_date	family_contact_name	family_contact_no	medical_application_date	medical_approval_date	medical_completion_date	medical_expiry_date	medical_status	medical_repeat_date	courrier_sent_date	courrier_received_date	visa_receiving_date	visa_issue_date	visa_expiry_date	ticket_booking_date	ticket_confirmation_date	onboarding_flight_city	fst_installment_amount	fst_installment_date	secnd_installment_amount	secnd_installment_date	third_installment_amount	third_installment_date	fourth_installment_amount	fourth_installment_date	deployment_date	job_interview_status
        // dd($rows);
        Validator::make($rows->toArray(), [
            '*.contact_no' => 'required|numeric|exists:candidates,contact_no',
            '*.company_name' => [
                'required',
                function ($attribute, $value, $fail) use ($rows) {
                    $index = explode('.', $attribute)[0];
                    $companyLocation = data_get($rows, "$index.company_location");

                    $rule = new CompanyNameLocationExists($value, $companyLocation);
                    if (!$rule->passes($attribute, $value)) {
                        $fail($rule->message());
                    }
                }
            ],
            '*.company_location' => 'required',
            '*.job_title' => [
                'required',
                function ($attribute, $value, $fail) use ($rows) {
                    $index = explode('.', $attribute)[0];
                    $companyName = data_get($rows, "$index.company_name");
                    $companyLocation = data_get($rows, "$index.company_location");
                    $rule = new CompanyNameJobExists($companyName,  $value, $companyLocation);
                    if (!$rule->passes($attribute, $value)) {
                        $fail($rule->message());
                    }
                }

            ],
            '*.interview_start_date' => 'required|date',
            // '*.interview_end_date' => 'required|date|after_or_equal:*.interview_start_date',
            '*.interview_end_date' => [
                'required',
                'date',
                'after_or_equal:*.interview_start_date',
                function ($attribute, $value, $fail) use ($rows) {
                    $index = explode('.', $attribute)[0];
                    $companyName = data_get($rows, "$index.company_name");
                    $companyLocation = data_get($rows, "$index.company_location");
                    $jobTitle = data_get($rows, "$index.job_title");
                    $startDate = data_get($rows, "$index.interview_start_date");
                    $rule = new CompanyInterviewExists($companyName,  $value, $companyLocation, $jobTitle, $startDate);
                    if (!$rule->passes($attribute, $value)) {
                        $fail($rule->message());
                    }
                }

            ],
            '*.date_of_interview' => 'required|date',
            '*.date_of_selection' => 'required|date|after_or_equal:*.date_of_interview',
            '*.mode_of_selection' => 'required|in:FULL TIME, PART TIME, CONTRACT',
            '*.client_remarks' => 'nullable',
            '*.sponsor' => 'nullable',
            '*.country' => 'required',
            '*.salary' => 'required|numeric',
            '*.food_allowance' => 'nullable|numeric',
            '*.mofa_date' => 'nullable|date',
            '*.vfs_applied_date' => 'nullable|date',
            '*.vfs_received_date' => 'nullable|date',
            '*.mofa_received_date' => 'nullable|date',
            '*.family_contact_name' => 'nullable',
            '*.family_contact_no' => 'nullable|numeric|digits:10',
            '*.medical_application_date' => 'nullable|date|required_with:*.medical_approval_date,*.medical_completion_date,*.medical_expiry_date, *.medical_status, *.medical_repeat_date',
            '*.medical_approval_date' => 'nullable|date|required_with:*.medical_completion_date,*.medical_expiry_date, *.medical_status, *.medical_repeat_date',
            '*.medical_completion_date' => 'nullable|date|required_with:*.medical_expiry_date, *.medical_status, *.medical_repeat_date',
            '*.medical_expiry_date' => 'nullable|date|required_with:*.medical_status, *.medical_repeat_date',
            '*.medical_status' => 'nullable',
            '*.medical_repeat_date' => 'nullable|date|required_if:*.medical_status,REPEAT',
            '*.courrier_sent_date' => 'nullable|date',
            '*.courrier_received_date' => 'nullable|date',
            '*.visa_receiving_date' => 'nullable|date',
            '*.visa_issue_date' => 'nullable|date',
            '*.visa_expiry_date' => 'nullable|date',
            '*.ticket_booking_date' => 'nullable|date',
            '*.ticket_confirmation_date' => 'nullable|date',
            '*.onboarding_flight_city' => 'nullable',
            '*.fst_installment_amount' => 'nullable|numeric',
            '*.fst_installment_date' => 'nullable|date',
            '*.secnd_installment_amount' => 'nullable|numeric',
            '*.secnd_installment_date' => 'nullable|date',
            '*.third_installment_amount' => 'nullable|numeric',
            '*.third_installment_date' => 'nullable|date',
            '*.fourth_installment_amount' => 'nullable|numeric',
            '*.fourth_installment_date' => 'nullable|date',
            '*.deployment_date' => 'nullable|date',
            '*.job_interview_status' => 'nullable|in:SELECTED,INTERESTED,NOT-INTERESTED',
        ], [
            'contact_no.required' => 'Contact number is required',
            'contact_no.numeric' => 'Contact number must be a number',
            'contact_no.exists' => 'Contact number does not exist in the system',
            'company_name.required' => 'Company name is required',
            'company_location.required' => 'Company location is required',
            'job_title.required' => 'Job title is required',
            'interview_start_date.required' => 'Interview start date is required',
            'interview_end_date.required' => 'Interview end date is required',
            'interview_end_date.after_or_equal' => 'Interview end date must be a date after or equal to the interview start date',
            'date_of_interview.required' => 'Date of interview is required',
            'date_of_selection.required' => 'Date of selection is required',
            'date_of_selection.after_or_equal' => 'Date of selection must be a date after or equal to the date of interview',
            'mode_of_selection.required' => 'Mode of selection is required',
            'mode_of_selection.in' => 'Mode of selection must be FULL TIME, PART TIME or CONTRACT',
            'country.required' => 'Country is required',
            'salary.required' => 'Salary is required',
            'salary.numeric' => 'Salary must be a number',
            'food_allowance.numeric' => 'Food allowance must be a number',
            'family_contact_no.numeric' => 'Family contact number must be a number',
            'family_contact_no.digits' => 'Family contact number must be 10 digits',
            'medical_application_date.required_with' => 'Medical application date is required when medical approval date, medical completion date, medical expiry date, medical status and medical repeat date are provided',
            'medical_approval_date.required_with' => 'Medical approval date is required when medical completion date, medical expiry date, medical status and medical repeat date are provided',
            'medical_completion_date.required_with' => 'Medical completion date is required when medical expiry date, medical status and medical repeat date are provided',
            'medical_expiry_date.required_with' => 'Medical expiry date is required when medical status and medical repeat date are provided',
            'medical_repeat_date.required_if' => 'Medical repeat date is required when medical status is REPEAT',
            'courrier_sent_date.date' => 'Courrier sent date must be a date',
            'courrier_received_date.date' => 'Courrier received date must be a date',
            'visa_receiving_date.date' => 'Visa receiving date must be a date',
            'visa_issue_date.date' => 'Visa issue date must be a date',
            'visa_expiry_date.date' => 'Visa expiry date must be a date',
            'ticket_booking_date.date' => 'Ticket booking date must be a date',
            'ticket_confirmation_date.date' => 'Ticket confirmation date must be a date',
            'fst_installment_amount.numeric' => 'First installment amount must be a number',
            'fst_installment_date.date' => 'First installment date must be a date',
            'secnd_installment_amount.numeric' => 'Second installment amount must be a number',
            'secnd_installment_date.date' => 'Second installment date must be a date',
            'third_installment_amount.numeric' => 'Third installment amount must be a number',
            'third_installment_date.date' => 'Third installment date must be a date',
            'fourth_installment_amount.numeric' => 'Fourth installment amount must be a number',
            'fourth_installment_date.date' => 'Fourth installment date must be a date',
            'deployment_date.date' => 'Deployment date must be a date',
            'job_interview_status.in' => 'Job interview status must be SELECTED, INTERESTED or NOT-INTERESTED',
        ])->validate();

        // dd($rows);
        try {
            foreach ($rows as $row) {

                $candidate = Candidate::where('contact_no', $row['contact_no'])->orderBy('id', 'desc')->first();

                if ($candidate) {
                    $companyName = $row['company_name'];
                    $companyLocation = $row['company_location'];
                    $jobTitle = $row['job_title'];
                    $interviewStartDate = $row['interview_start_date'];
                    $interviewEndDate = $row['interview_end_date'];


                    $company = Company::where('company_name', $companyName)
                        ->where('company_address', $companyLocation)
                        ->orderBy('id', 'desc')
                        ->first();
                        // dd($companyName, $companyLocation, $jobTitle, $interviewStartDate, $interviewEndDate, $company->id);
                    if ($company) {
                        $job = Job::where('job_name', $jobTitle)
                            ->where('company_id', $company->id)
                            ->orderBy('id', 'desc')
                            ->first();

                        if ($job) {

                            $interview = Interview::where('company_id', $company->id)
                                ->where('job_id', $job->id)
                                ->where('interview_start_date', $interviewStartDate)
                                ->where('interview_end_date', $interviewEndDate)
                                ->orderBy('id', 'desc')
                                ->first();
                            if ($interview) {

                                $check = CandidateJob::where('candidate_id', $candidate->id)
                                    ->where('job_id', $job->id)
                                    ->where('interview_id', $interview->id)
                                    ->count();
                                    // dd($check);
                                if ($check <= 0) {
                                    $assign_job = new AssignJob();

                                    $assign_job->candidate_id = $candidate->id;
                                    $assign_job->job_id = $job->id;
                                    $assign_job->company_id = $company->id;
                                    $assign_job->interview_id = $interview->id;
                                    $assign_job->user_id = Auth::user()->id;
                                    $assign_job->interview_status = 'Interested';
                                    $assign_job->save();

                                    $candidate_job = new CandidateJob();
                                    $candidate_job->candidate_id = $candidate->id;
                                    $candidate_job->assign_by_id = auth()->id();
                                    $candidate_job->assign_job_id = $assign_job->id;
                                    $candidate_job->full_name = $candidate->full_name ?? null;
                                    $candidate_job->email = $candidate->email ?? null;
                                    $candidate_job->gender = $candidate->gender ?? null;
                                    $candidate_job->date_of_birth = $candidate->dob ?? null;
                                    $candidate_job->whatapp_no = $candidate->whatapp_no ?? null;
                                    $candidate_job->alternate_contact_no = $candidate->alternate_contact_no ?? null;
                                    $candidate_job->religion = $candidate->religion ?? null;
                                    $candidate_job->city = $candidate->city ?? null;
                                    $candidate_job->address = $candidate->address ?? null;
                                    $candidate_job->education = $candidate->education ?? null;
                                    $candidate_job->other_education = $candidate->other_education ?? null;
                                    $candidate_job->passport_number = $candidate->passport_number ?? null;
                                    $candidate_job->english_speak = $candidate->english_speak ?? null;
                                    $candidate_job->arabic_speak = $candidate->arabic_speak ?? null;
                                    $candidate_job->job_id = $job->id;
                                    $candidate_job->job_position = $job->candidate_position_id;
                                    $candidate_job->job_location = $job->address;
                                    $candidate_job->company_id = $company->id;
                                    $candidate_job->job_interview_status = $row['job_interview_status'];
                                    $candidate_job->interview_id = $interview->id;
                                    $candidate_job->vendor_id = $job->vendor_id;

                                    $vendor = User::where('id', $job->vendor_id)->first();
                                    $candidate_job->vendor_service_charge = $vendor->vendor_service_charge ?? null;

                                    $candidate_job->date_of_interview = $row['date_of_interview'] ?? null;
                                    $candidate_job->date_of_selection = $row['date_of_selection'] ?? null;
                                    $candidate_job->mode_of_selection = $row['mode_of_selection'] ?? null;
                                    $candidate_job->interview_location = $job->address;
                                    $candidate_job->client_remarks = $row['client_remarks'] ?? null;
                                    $candidate_job->other_remarks = $row['other_remarks'] ?? null;
                                    $candidate_job->sponsor = $row['sponsor'] ?? null;
                                    $candidate_job->country = $row['country'] ?? null;
                                    $candidate_job->salary = $row['salary'] ?? null;
                                    $candidate_job->food_allowance = $row['food_allowance'] ?? null;
                                    $candidate_job->contract_duration = $job->contract ?? null;

                                    $candidate_job->family_contact_name = $row['family_contact_name'] ?? null;
                                    $candidate_job->family_contact_no = $row['family_contact_no'] ?? null;

                                    $candidate_job->medical_application_date = $row['medical_application_date']  ?? null;
                                    $candidate_job->medical_approval_date = $row['medical_approval_date'] ?? null;
                                    $candidate_job->medical_completion_date = $row['medical_completion_date'] ?? null;
                                    $candidate_job->medical_expiry_date  = $row['medical_expiry_date'] ?? null;
                                    $candidate_job->medical_status = $row['medical_status'] ?? null;
                                    if ($row['medical_status'] == 'REPEAT') {
                                        $candidate_job->medical_repeat_date =  $row['medical_repeat_date'] ?? null;
                                    } else {
                                        $candidate_job->medical_repeat_date = null;
                                    }

                                    $candidate_job->visa_receiving_date =  $row['visa_receiving_date'] ?? null;
                                    $candidate_job->visa_issue_date =  $row['visa_issue_date'] ?? null;
                                    $candidate_job->visa_expiry_date = $row['visa_expiry_date'] ?? null;
                                    $candidate_job->mofa_no =   $row['mofa_no'] ?? null;
                                    $candidate_job->mofa_date =   $row['mofa_date'] ?? null;
                                    $candidate_job->mofa_received_date =  $row['mofa_received_date'] ?? null;
                                    $candidate_job->vfs_applied_date =  $row['vfs_applied_date'] ?? null;
                                    $candidate_job->vfs_received_date =  $row['vfs_received_date'] ?? null;

                                    $candidate_job->ticket_booking_date =  $row['ticket_booking_date'] ?? null;
                                    $candidate_job->ticket_confirmation_date = $row['ticket_confirmation_date'] ?? null;
                                    $candidate_job->onboarding_flight_city = $row['onboarding_flight_city'] ?? null;


                                    $candidate_job->courrier_sent_date = $row['courrier_sent_date'] ?? null;
                                    $candidate_job->courrier_received_date = $row['courrier_received_date'] ?? null;

                                    $first_installment = $row['fst_installment_amount'] ?? 0;
                                    $second_installment = $row['secnd_installment_amount'] ?? 0;
                                    $third_installment = $row['third_installment_amount'] ?? 0;
                                    $fourth_installment = $row['fourth_installment_amount'] ?? 0;


                                    $candidate_job->fst_installment_amount = $row['fst_installment_amount'] > 0 ? $row['fst_installment_amount'] : null;
                                    $candidate_job->fst_installment_date = $row['fst_installment_date'] ?? null;
                                    $candidate_job->secnd_installment_amount =  $row['secnd_installment_amount']  > 0 ? $row['secnd_installment_amount'] : null;
                                    $candidate_job->secnd_installment_date = $row['secnd_installment_date'] ?? null;
                                    $candidate_job->third_installment_amount =  $row['third_installment_amount']  > 0 ? $row['third_installment_amount'] : null;
                                    $candidate_job->third_installment_date = $row['third_installment_date'] ?? null;
                                    $candidate_job->fourth_installment_amount = $row['fourth_installment_amount']  > 0 ? $row['fourth_installment_amount'] : null;
                                    $candidate_job->fourth_installment_date = $row['fourth_installment_date'] ?? null;
                                    $candidate_job->total_amount = $first_installment + $second_installment + $third_installment + $fourth_installment;
                                    $candidate_job->deployment_date = $row['deployment_date'] ?? null;

                                    $candidate_job->save();

                                    $candidate_refer = Candidate::where('id', $candidate_job->candidate_id)->first() ?? '';
                                    $job_referral_point = Job::where('id', $candidate_job->job_id)->first() ?? '';
                                    $referral_amount = ReferralPoint::where('id', $job_referral_point->referral_point_id)->first() ?? '';
                                    // dd($candidate_refer);
                                    if ($row['deployment_date'] && isset($candidate_refer->referred_by_id)) {

                                        $refer_point = new CandidateReferralPoint();
                                        $refer_point->refer_candidate_id = $candidate_job->candidate_id ?? null;
                                        $refer_point->referrer_candidate_id = $candidate_refer->referred_by_id ?? null;
                                        $refer_point->refer_point_id = $job_referral_point->referral_point_id ?? null;
                                        $refer_point->refer_point = $referral_amount->point ?? null;
                                        $refer_point->amount = $referral_amount->amount ?? null;
                                        $refer_point->refer_job_id = $candidate_job->job_id ?? null;
                                        $refer_point->save();
                                    }


                                    if (isset($candidate->candidateIndianLicence) && count($candidate->candidateIndianLicence) > 0) {
                                        foreach ($candidate->candidateIndianLicence as $indianLicence) {
                                            $candidate_ind_licence = new CandJobLicence();
                                            $candidate_ind_licence->candidate_job_id = $candidate_job->id;
                                            $candidate_ind_licence->candidate_id = $candidate->id;
                                            $candidate_ind_licence->licence_type = 'indian';
                                            $candidate_ind_licence->licence_name = $indianLicence->licence_name;
                                            $candidate_ind_licence->save();
                                        }
                                    }

                                    if (isset($candidate->candidateGulfLicence) && count($candidate->candidateGulfLicence) > 0) {
                                        foreach ($candidate->candidateGulfLicence as $gulfLicence) {
                                            $candidate_gulf_licence = new CandJobLicence();
                                            $candidate_gulf_licence->candidate_job_id = $candidate_job->id;
                                            $candidate_gulf_licence->candidate_id = $candidate->id;
                                            $candidate_gulf_licence->licence_type = 'gulf';
                                            $candidate_gulf_licence->licence_name = $gulfLicence->licence_name;
                                            $candidate_gulf_licence->save();
                                        }
                                    }
                                } 
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
