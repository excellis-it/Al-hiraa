<?php

namespace App\Exports;

use App\Models\CandidateJob;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Auth;

class CandidateJobExport implements FromQuery, WithMapping, WithHeadings, WithChunkReading

{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = CandidateJob::query()->with(['associate', 'company', 'jobTitle.candidatePosition', 'cityName']);

        if (!empty($this->filters['candidate_ids'])) {
            $ids = is_array($this->filters['candidate_ids']) ? $this->filters['candidate_ids'] : explode(',', $this->filters['candidate_ids']);
            $query->whereIn('id', $ids);
        } else {
            // Apply date filters if present
            if (!empty($this->filters['start_date']) && !empty($this->filters['end_date'])) {
                $start = Carbon::parse($this->filters['start_date'])->startOfDay();
                $end   = Carbon::parse($this->filters['end_date'])->endOfDay();

                $query->whereBetween('created_at', [$start, $end]);
                // $query->whereBetween('created_at', [$this->filters['start_date'], $this->filters['end_date']]);
            }

            // Apply search filter
            if (!empty($this->filters['search'])) {
                $search = $this->filters['search'];
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
                                });
                        });
                    }
                });
            }

            // Apply company filter
            if (!empty($this->filters['company'])) {
                $query->where('company_id', $this->filters['company']);
            }

            // Apply job filter
            if (!empty($this->filters['job_id'])) {
                $job_ids = $this->filters['job_id'];
                if (!is_array($job_ids)) {
                    $job_ids = explode(',', $job_ids);
                }
                $query->whereIn('job_id', $job_ids);
            }

            // Apply interview pipeline filter
            if (!empty($this->filters['int_pipeline'])) {
                $this->applyInterviewPipelineFilter($query, $this->filters['int_pipeline']);
            }

            // Apply role-based filtering (same as index method)
            $user = Auth::user();
            if ($user->hasRole('DATA ENTRY OPERATOR') || $user->hasRole('RECRUITER')) {
                $query->where('assign_by_id', $user->id)
                    ->whereNull('medical_status')
                    ->whereNull('visa_receiving_date')
                    ->whereNull('total_amount')
                    ->whereNull('deployment_date');
            } elseif ($user->hasRole('PROCESS MANAGER')) {
                $query->where(function ($q) {
                    $q->where('job_interview_status', 'Selected')->orWhereNotNull('medical_status')
                        ->orWhereNotNull('visa_receiving_date')
                        ->orWhereNotNull('total_amount')
                        ->orWhereNotNull('deployment_date');
                });
            }

            // More filters based on index logic
            if (!empty($this->filters['medical_type']) && !empty($this->filters['company_id'])) {
                $query->where('medical_status', $this->filters['medical_type'])->where('company_id', $this->filters['company_id']);
            } elseif (!empty($this->filters['interestedType']) && !empty($this->filters['interviewId'])) {
                if ($this->filters['interestedType'] == 'self' || $this->filters['interestedType'] == 'team') {
                    $query->where('interview_id', $this->filters['interviewId']);
                }
            }
        }

        return $query->orderBy('id', 'desc');
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    private function applyInterviewPipelineFilter($query, $int_pipeline)
    {
        switch ($int_pipeline) {
            case 'All':
                $query->where('job_interview_status', 'Interested')
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
        }
    }

    /**
     * Map data for each row
     */
    public function map($row): array
    {
        return [
            $row->id,
            // Candidate Details
            $row->full_name,
            $row->passport_number,
            $row->passport_expiry,
            $row->contact_no,
            $row->whatapp_no,
            $row->alternate_contact_no,
            $row->email,
            $row->gender,
            $row->date_of_birth,
            $row->religion,
            $row->ecr_type,
            $row->associate->name ?? 'N/A',
            $row->address,

            // Job Details
            $row->company->company_name ?? 'N/A',
            $row->jobTitle->job_name ?? 'N/A',
            $row->jobTitle->candidatePosition->name ?? 'N/A',
            $row->job_location,
            $row->country,
            $row->date_of_interview,
            $row->date_of_selection,
            $row->mode_of_selection,
            $row->interview_location,
            $row->client_remarks,
            $row->other_remarks,
            $row->sponsor,
            $row->salary,
            $row->food_allowance,
            $row->contract_duration,
            $row->job_service_charge,
            $row->vendor_service_charge,

            // Medical Details
            $row->medical_status,
            $row->medical_application_date,
            $row->medical_completion_date,
            $row->medical_approval_date,
            $row->medical_expiry_date,
            $row->medical_repeat_date,

            // Family Details
            $row->family_contact_name,
            $row->family_contact_no,

            // Installment Details
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
            $row->total_amount,
            $row->due_amount,

            // Courier Details
            $row->courrier_sent_date,
            $row->courrier_received_date,

            // Visa Details
            $row->visa_receiving_date,
            $row->visa_issue_date,
            $row->visa_expiry_date,
            $row->mofa_no,
            $row->mofa_date,
            $row->mofa_received_date,
            $row->vfs_applied_date,
            $row->vfs_received_date,

            // Flight Details
            $row->ticket_booking_date,
            $row->ticket_confirmation_date,
            $row->onboarding_flight_city,
            $row->deployment_date,

            // Status
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
            // Candidate Details
            'Full Name',
            'Passport Number',
            'Passport Expiry',
            'Contact No',
            'WhatsApp No',
            'Alternate Contact No',
            'Email',
            'Gender',
            'Date of Birth',
            'Religion',
            'ECR Type',
            'Associate',
            'Address',

            // Job Details
            'Company',
            'Job Title',
            'Job Position',
            'Job Location',
            'Country',
            'Date of Interview',
            'Date of Selection',
            'Mode of Selection',
            'Interview Location',
            'Client Remarks',
            'Other Remarks',
            'Sponsor',
            'Salary',
            'Food Allowance',
            'Contract Duration',
            'Job Service Charge',
            'Vendor Service Charge',

            // Medical Details
            'Medical Status',
            'Medical Application Date',
            'Medical Completion Date',
            'Medical Approval Date',
            'Medical Expiry Date',
            'Medical Repeat Date',

            // Family Details
            'Family Contact Name',
            'Family Contact No',

            // Installment Details
            '1st Installment Amount',
            '1st Installment Date',
            '1st Installment Remarks',
            '2nd Installment Amount',
            '2nd Installment Date',
            '2nd Installment Remarks',
            '3rd Installment Amount',
            '3rd Installment Date',
            '3rd Installment Remarks',
            '4th Installment Amount',
            '4th Installment Date',
            '4th Installment Remarks',
            'Discount',
            'Total Amount',
            'Due Amount',

            // Courier Details
            'Courier Sent Date',
            'Courier Received Date',

            // Visa Details
            'Visa Receiving Date',
            'Visa Issue Date',
            'Visa Expiry Date',
            'MOFA No',
            'MOFA Date',
            'MOFA Received Date',
            'VFS Applied Date',
            'VFS Received Date',

            // Flight Details
            'Flight Booking Date',
            'Flight Confirmation Date',
            'Onboarding Flight City',
            'Deployment Date',

            // Status
            'Job Status',
            'Job Interview Status',
        ];
    }
}
