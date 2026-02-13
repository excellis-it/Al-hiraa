<?php

namespace App\Imports;

use App\Models\AssignJob;
use App\Models\Associate;
use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\CandidatePosition;
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CandidateJobImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        // interview_start_date	interview_end_date	date_of_interview	date_of_selection	mode_of_selection	interview_location	client_remarks	sponsor	country	salary	food_allowance	mofa_date	vfs_applied_date	vfs_received_date	mofa_received_date	family_contact_name	family_contact_no	medical_application_date	medical_approval_date	medical_completion_date	medical_expiry_date	medical_status	medical_repeat_date	courrier_sent_date	courrier_received_date	visa_receiving_date	visa_issue_date	visa_expiry_date	ticket_booking_date	ticket_confirmation_date	onboarding_flight_city	fst_installment_amount	fst_installment_date	secnd_installment_amount	secnd_installment_date	third_installment_amount	third_installment_date	fourth_installment_amount	fourth_installment_date	deployment_date	job_interview_status
        $rows = $rows->filter(function ($row) {
            return array_filter($row->toArray());
        });

        $cleanedRows = $rows->map(function ($row) {
            // passport expiry
            $row['passport_expiry_date'] = $this->formatExcelDate($row['passport_expiry_date']);
            $row['date_of_selection'] = $this->formatExcelDate($row['date_of_selection']);
            $row['mofa_date'] = $this->formatExcelDate($row['mofa_date']);
            $row['vfs_applied_date'] = $this->formatExcelDate($row['vfs_applied_date']);
            $row['vfs_received_date'] = $this->formatExcelDate($row['vfs_received_date']);
            $row['mofa_received_date'] = $this->formatExcelDate($row['mofa_received_date']);
            $row['medical_application_date'] = $this->formatExcelDate($row['medical_application_date']);
            $row['medical_approval_date'] = $this->formatExcelDate($row['medical_approval_date']);
            $row['medical_completion_date'] = $this->formatExcelDate($row['medical_completion_date']);
            $row['medical_expiry_date'] = $this->formatExcelDate($row['medical_expiry_date']);
            $row['medical_repeat_date'] = $this->formatExcelDate($row['medical_repeat_date']);
            $row['courrier_sent_date'] = $this->formatExcelDate($row['courrier_sent_date']);
            $row['courrier_received_date'] = $this->formatExcelDate($row['courrier_received_date']);
            $row['visa_receiving_date'] = $this->formatExcelDate($row['visa_receiving_date']);
            $row['visa_issue_date'] = $this->formatExcelDate($row['visa_issue_date']);
            $row['visa_expiry_date'] = $this->formatExcelDate($row['visa_expiry_date']);
            $row['ticket_booking_date'] = $this->formatExcelDate($row['ticket_booking_date']);
            $row['ticket_confirmation_date'] = $this->formatExcelDate($row['ticket_confirmation_date']);
            $row['fst_installment_date'] = $this->formatExcelDate($row['fst_installment_date']);
            $row['secnd_installment_date'] = $this->formatExcelDate($row['secnd_installment_date']);
            $row['third_installment_date'] = $this->formatExcelDate($row['third_installment_date']);
            $row['fourth_installment_date'] = $this->formatExcelDate($row['fourth_installment_date']);
            $row['deployment_date'] = $this->formatExcelDate($row['deployment_date']);
            $row['dob'] = $this->formatExcelDate($row['dob']);

            return $row;
        });
        // dd($cleanedRows->toArray());
        Validator::make($cleanedRows->toArray(), [
            '*.whatapp_no' => 'nullable|digits:10|numeric',
            '*.full_name' => 'required',
            '*.dob' => 'required|date|before:today',
            '*.contact_no' => 'nullable|numeric|digits:10',
            '*.email' => 'nullable|email',
            // passport no
            '*.passport_number' => 'required|regex:/^[A-Za-z]\d{7}$/',
            '*.passport_expiry_date' => 'required|date|after:today',
            //ecr type
            '*.ecr_type' => 'nullable|in:ECR,ECNR',
            // alternate_contact_no
            '*.alternate_contact_no' => 'nullable|numeric|digits:10',
            // address
            '*.address' => 'nullable',
            '*.associate_phone' => 'nullable|numeric|digits:10',
            '*.associate_name' => 'nullable',
            // gender
            '*.gender' => 'nullable|in:MALE,FEMALE,OTHER',
            // religion
            '*.religion' => 'nullable|in:HINDU,MUSLIM,CHRISTIAN,SIKH,BUDDHIST,JAIN,OTHER',
            // COUNTRY
            '*.country' => 'nullable',
            '*.date_of_selection' => 'required|date|after_or_equal:*.date_of_interview',
            '*.mode_of_selection' => 'nullable|in:FACE TO FACE,ONLINE,DIRECT',
            '*.client_remarks' => 'nullable',
            '*.interview_id' => 'required|exists:interviews,interview_id',
            '*.sponsor' => 'nullable',
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
            '*.medical_status' => 'nullable|in:FIT,UNFIT,REPEAT',
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
        ], [
            'full_name.required' => 'Full name is required',
            'dob.required' => 'Date of birth is required',
            'dob.date' => 'Date of birth must be a date',
            'dob.before' => 'Date of birth must be a date before today',
            'contact_no.required' => 'Contact number is required',
            'contact_no.numeric' => 'Contact number must be a number',
            'contact_no.exists' => 'Contact number does not exist in the system',
            'passport_number.required' => 'Passport number is required',
            'passport_number.regex' => 'Passport number must be a valid passport number',
            'passport_expiry_date.required' => 'Passport expiry date is required',
            'passport_expiry_date.date' => 'Passport expiry date must be a date',
            'passport_expiry_date.after' => 'Passport expiry date must be a date after today',
            'ecr_type.in' => 'ECR type must be ECR or ECNR',
            'alternate_contact_no.numeric' => 'Alternate contact number must be a number',
            'alternate_contact_no.digits' => 'Alternate contact number must be a 10 digit number',
            'gender.in' => 'Gender must be MALE, FEMALE or OTHER',
            'religion.in' => 'Religion must be HINDU, MUSLIM, CHRISTIAN, SIKH, BUDDHIST, JAIN or OTHER',
            'country.required' => 'Country is required',

            'date_of_selection.required' => 'Date of selection is required',
            'date_of_selection.after_or_equal' => 'Date of selection must be a date after or equal to the date of interview',
            // 'mode_of_selection.required' => 'Mode of selection is required',
            'mode_of_selection.in' => 'Mode of selection must be FULL TIME, PART TIME or CONTRACT',

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
        ])->validate();

        // dd($rows);
        try {
            foreach ($rows as $row) {

                $interview = Interview::with(['company', 'job'])->where('interview_id', $row['interview_id'])
                    ->first();
                if ($interview) {

                    $check = CandidateJob::where('passport_number', $row['passport_number'])
                        ->where('job_id', $interview->job_id)
                        ->where('interview_id', $interview->id)
                        ->count();

                    // dd($check);
                    if ($check <= 0) {
                        $assign_job = new AssignJob();
                        $assign_job->job_id = $interview->job_id;
                        $assign_job->company_id = $interview->company_id;
                        $assign_job->interview_id = $interview->id;
                        $assign_job->user_id = Auth::user()->id;
                        $assign_job->interview_status = 'Interested';
                        $assign_job->save();

                        $candidate_job = new CandidateJob();
                        $candidate_job->assign_by_id = auth()->id();
                        $candidate_job->contact_no = $row['contact_no'] ?? null;
                        $candidate_job->assign_job_id = $assign_job->id;
                        $candidate_job->full_name = $row['full_name'] ?? null;
                        $candidate_job->email = $row['email'] ?? null;
                        $candidate_job->gender = $row['gender'] ?? null;
                        $candidate_job->date_of_birth = $row['dob'] ?? null;
                        $candidate_job->whatapp_no = $row['whatapp_no'] ? '+91' . $row['whatapp_no'] : null;
                        $candidate_job->alternate_contact_no = $row['alternate_contact_no'] ?? null;
                        $candidate_job->religion = $row['religion'] ?? null;
                        $candidate_job->address = $row['address'] ?? null;
                        $candidate_job->passport_number = $row['passport_number'] ?? null;
                        $candidate_job->passport_expiry = $row['passport_expiry_date'] ?? null;
                        $candidate_job->ecr_type = $row['ecr_type'] ?? null;

                        if (isset($row['associate_phone'])) {
                            $associate = Associate::where('phone_number', $row['associate_phone'])->first();
                            if ($associate) {
                                $candidate_job->associate_id = $associate->id;
                            } else {
                                $associate = Associate::create([
                                    'phone_number' => $row['associate_phone'],
                                    'name' => $row['associate_name'],
                                    'associate_id' => Associate::generateAssociateId(),
                                ]);
                                $candidate_job->associate_id = $associate->id;
                            }
                            $candidate_job->due_amount = $interview->job->associate_charge ?? null;
                            $candidate_job->associate_charge = $interview->job->associate_charge ?? null;
                        } else {
                            $candidate_job->due_amount = $interview->job->service_charge ?? null;
                            $candidate_job->job_service_charge = $interview->job->service_charge ?? null;
                        }

                        $candidate_job->job_id = $interview->job_id;
                        $candidate_job->job_position = $interview->job->candidate_position_id ?? null;
                        $candidate_job->job_location = $interview->job->address ?? null;
                        $candidate_job->company_id = $interview->company_id;


                        $candidate_job->food_allowance = $interview->job->benifits ?? null;
                        $candidate_job->contract_duration = $interview->job->contract ?? null;
                        $candidate_job->date_of_interview = $interview->interview_start_date ?? null;
                        $candidate_job->interview_location = $interview->interview_location ?? null;


                        $candidate_job->job_interview_status = 'SELECTED';
                        $candidate_job->interview_id = $interview->id;
                        $candidate_job->vendor_id = $interview->job->vendor_id ?? null;

                        if (isset($interview->job->vendor_id)) {
                            $vendor = User::where('id', $interview->job->vendor_id)->first();
                            $candidate_job->vendor_service_charge = $vendor->vendor_service_charge ?? null;
                        }

                        $candidate_job->date_of_selection = $this->formatExcelDate($row['date_of_selection']) ?? null;
                        $candidate_job->mode_of_selection = $row['mode_of_selection'] ?? null;
                        $candidate_job->interview_location = $interview->job->address ?? null;
                        $candidate_job->client_remarks = $row['client_remarks'] ?? null;
                        $candidate_job->other_remarks = $row['other_remarks'] ?? null;
                        $candidate_job->sponsor = $row['sponsor'] ?? null;
                        $candidate_job->country = $row['country'] ?? null;
                        $candidate_job->salary = $interview->job->salary ?? null;

                        $candidate_job->contract_duration = $interview->job->contract ?? null;

                        $candidate_job->family_contact_name = $row['family_contact_name'] ?? null;
                        $candidate_job->family_contact_no = $row['family_contact_no'] ?? null;

                        $candidate_job->medical_application_date = $this->formatExcelDate($row['medical_application_date'])  ?? null;
                        $candidate_job->medical_approval_date = $this->formatExcelDate($row['medical_approval_date']) ?? null;
                        $candidate_job->medical_completion_date = $this->formatExcelDate($row['medical_completion_date']) ?? null;
                        $candidate_job->medical_expiry_date  = $this->formatExcelDate($row['medical_expiry_date']) ?? null;
                        $candidate_job->medical_status = $row['medical_status'] ?? null;
                        if ($row['medical_status'] == 'REPEAT') {
                            $candidate_job->medical_repeat_date =  $this->formatExcelDate($row['medical_repeat_date']) ?? null;
                        } else {
                            $candidate_job->medical_repeat_date = null;
                        }

                        $candidate_job->visa_receiving_date =  $row['visa_receiving_date'] ?? null;
                        $candidate_job->visa_issue_date =  $this->formatExcelDate($row['visa_issue_date']) ?? null;
                        $candidate_job->visa_expiry_date = $this->formatExcelDate($row['visa_expiry_date']) ?? null;
                        $candidate_job->mofa_no =   $row['mofa_no'] ?? null;
                        $candidate_job->mofa_date =   $row['mofa_date'] ?? null;
                        $candidate_job->mofa_received_date =  $this->formatExcelDate($row['mofa_received_date']) ?? null;
                        $candidate_job->vfs_applied_date =  $this->formatExcelDate($row['vfs_applied_date']) ?? null;
                        $candidate_job->vfs_received_date =  $this->formatExcelDate($row['vfs_received_date']) ?? null;

                        $candidate_job->ticket_booking_date =  $this->formatExcelDate($row['ticket_booking_date']) ?? null;
                        $candidate_job->ticket_confirmation_date = $this->formatExcelDate($row['ticket_confirmation_date']) ?? null;
                        $candidate_job->onboarding_flight_city = $row['onboarding_flight_city'] ?? null;


                        $candidate_job->courrier_sent_date = $this->formatExcelDate($row['courrier_sent_date']) ?? null;
                        $candidate_job->courrier_received_date = $this->formatExcelDate($row['courrier_received_date']) ?? null;

                        $first_installment = $row['fst_installment_amount'] ?? 0;
                        $second_installment = $row['secnd_installment_amount'] ?? 0;
                        $third_installment = $row['third_installment_amount'] ?? 0;
                        $fourth_installment = $row['fourth_installment_amount'] ?? 0;


                        $candidate_job->fst_installment_amount = $row['fst_installment_amount'] > 0 ? $row['fst_installment_amount'] : null;
                        $candidate_job->fst_installment_date = $this->formatExcelDate($row['fst_installment_date']) ?? null;
                        $candidate_job->secnd_installment_amount =  $row['secnd_installment_amount']  > 0 ? $row['secnd_installment_amount'] : null;
                        $candidate_job->secnd_installment_date = $this->formatExcelDate($row['secnd_installment_date']) ?? null;
                        $candidate_job->third_installment_amount =  $row['third_installment_amount']  > 0 ? $row['third_installment_amount'] : null;
                        $candidate_job->third_installment_date = $this->formatExcelDate($row['third_installment_date']) ?? null;
                        $candidate_job->fourth_installment_amount = $row['fourth_installment_amount']  > 0 ? $row['fourth_installment_amount'] : null;
                        $candidate_job->fourth_installment_date = $this->formatExcelDate($row['fourth_installment_date']) ?? null;
                        $total_amout = $first_installment + $second_installment + $third_installment + $fourth_installment;
                        $candidate_job->total_amount = $total_amout > 0 ? $total_amout : null;
                        $candidate_job->deployment_date = $this->formatExcelDate($row['deployment_date']) ?? null;

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
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    private function formatExcelDate($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('d-m-Y');
            } catch (\Exception $e) {
                return null;
            }
        }

        try {
            return \Carbon\Carbon::parse($value)->format('d-m-Y');
        } catch (\Exception $e) {
            return null;
        }
    }


    public function headingRow(): int
    {
        return 1;
    }
}
