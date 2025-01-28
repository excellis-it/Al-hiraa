<?php

namespace App\Exports;

use App\Models\CandidateJob;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CandidateInterviewExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $candidateIds;

    public function __construct($candidateIds)
    {
        $this->candidateIds = $candidateIds;
    }


    public function query()
    {
        return CandidateJob::query()
            ->where('candidate_id', $this->candidateIds);
    }

    /**
     * Map data for each row
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->full_name,
            $row->email,
            $row->gender,
            $row->date_of_birth,
            $row->whatapp_no,
            $row->alternate_contact_no,
            $row->religion,
            $row->cityName->name ?? '',
            $row->address,
            $row->education,
            $row->other_education,
            $row->passport_number,
            $row->english_speak,
            $row->arabic_speak,
            $row->jobTitle->candidatePosition->name ?? '',
            $row->job_location,
            $row->date_of_interview,
            $row->date_of_selection,
            $row->mode_of_selection,
            $row->interview_location,
            $row->client_remarks,
            $row->other_remarks,
            $row->sponsor,
            $row->country,
            $row->salary,
            $row->food_allowance,
            $row->contract_duration,
            $row->mofa_no,
            $row->mofa_date,
            $row->vfs_applied_date,
            $row->vfs_received_date,
            $row->mofa_received_date,
            $row->family_contact_name,
            $row->family_contact_no,
            $row->medical_application_date,
            $row->medical_approval_date,
            $row->medical_completion_date,
            $row->medical_expiry_date,
            $row->medical_status,
            $row->medical_repeat_date,
            $row->courrier_sent_date,
            $row->courrier_received_date,
            $row->visa_receiving_date,
            $row->visa_issue_date,
            $row->visa_expiry_date,
            $row->ticket_booking_date,
            $row->ticket_confirmation_date,
            $row->onboarding_flight_city,
            $row->total_amount,
            $row->due_amount,
            $row->fst_installment_amount,
            $row->fst_installment_date,
            $row->fst_installment_remarks,
            $row->secnd_installment_amount,
            $row->secnd_installment_date,
            $row->secnd_installment_remarks,
            $row->third_installment_amount,
            $row->third_installment_date,
            $row->third_installment_remarks,
            $row->fourth_installment_amount,
            $row->fourth_installment_date,
            $row->fourth_installment_remarks,
            $row->discount,
            $row->deployment_date,
            $row->vendor_service_charge,
            $row->job_service_charge,
            $row->job_status,
            $row->job_interview_status,
        ];
    }

    /**
     * Define headers for the export
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Gender',
            'Date of Birth',
            'WhatsApp No',
            'Alternate Contact No',
            'Religion',
            'City',
            'Address',
            'Education',
            'Other Education',
            'Passport Number',
            'English Speak',
            'Arabic Speak',
            'Job Position',
            'Job Location',
            'Date of Interview',
            'Date of Selection',
            'Mode of Selection',
            'Interview Location',
            'Client Remarks',
            'Other Remarks',
            'Sponsor',
            'Country',
            'Salary',
            'Food Allowance',
            'Contract Duration',
            'MOFA No',
            'MOFA Date',
            'VFS Applied Date',
            'VFS Received Date',
            'MOFA Received Date',
            'Family Contact Name',
            'Family Contact No',
            'Medical Application Date',
            'Medical Approval Date',
            'Medical Completion Date',
            'Medical Expiry Date',
            'Medical Status',
            'Medical Repeat Date',
            'Courier Sent Date',
            'Courier Received Date',
            'Visa Receiving Date',
            'Visa Issue Date',
            'Visa Expiry Date',
            'Ticket Booking Date',
            'Ticket Confirmation Date',
            'Onboarding Flight City',
            'Total Amount',
            'Due Amount',
            'First Installment Amount',
            'First Installment Date',
            'First Installment Remarks',
            'Second Installment Amount',
            'Second Installment Date',
            'Second Installment Remarks',
            'Third Installment Amount',
            'Third Installment Date',
            'Third Installment Remarks',
            'Fourth Installment Amount',
            'Fourth Installment Date',
            'Fourth Installment Remarks',
            'Discount',
            'Deployment Date',
            'Vendor Service Charge',
            'Job Service Charge',
            'Job Status',
            'Job Interview Status',
        ];
    }
}
