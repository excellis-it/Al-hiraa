<?php

namespace App\Imports;

use App\Rules\CompanyNameJobExists;
use App\Rules\CompanyNameLocationExists;
use Illuminate\Support\Collection;
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
            '*.job_title' =>[
                'required',
                function ($attribute, $value, $fail) use ($rows) {
                    $index = explode('.', $attribute)[0];
                    $companyName = data_get($rows, "$index.company_name");

                    $rule = new CompanyNameJobExists($companyName, $value);
                    if (!$rule->passes($attribute, $value)) {
                        $fail($rule->message());
                    }
                }

            ],
            '*.interview_start_date' => 'required|date',
            '*.interview_end_date' => 'required|date|after_or_equal:*.interview_start_date',
            '*.date_of_interview' => 'required|date',
            '*.date_of_selection' => 'required|date|after_or_equal:*.date_of_interview',
            '*.mode_of_selection' => 'required|in:FULL TIME, PART TIME, CONTRACT',
            '*.interview_location' => 'required',
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
            'interview_location.required' => 'Interview location is required',
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



    }
}
