<?php

namespace App\Exports;

use App\Models\Lineup;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class LineupsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $today = date('Y-m-d');
        $query = Lineup::with(['vendor', 'company', 'job', 'interview', 'user', 'statusUpdater']);

        // Base filter: only upcoming/today interviews (consistent with UI logic)
        $query->whereHas('interview', function ($q) use ($today) {
            $q->where(DB::raw('STR_TO_DATE(interview_start_date, "%d-%m-%Y")'), '>=', $today);
        });

        // Apply filters
        if (!empty($this->request['ids'])) {
            $ids = explode(',', $this->request['ids']);
            $query->whereIn('id', $ids);
        } else {
            if (!empty($this->request['company_id'])) {
                $query->where('company_id', $this->request['company_id']);
            }

            if (!empty($this->request['job_id'])) {
                $query->where('job_id', $this->request['job_id']);
            }

            if (!empty($this->request['interview_id'])) {
                $query->where('interview_id', $this->request['interview_id']);
            }

            if (!empty($this->request['interview_status'])) {
                $query->where('interview_status', $this->request['interview_status']);
            }

            if (!empty($this->request['search'])) {
                $search = $this->request['search'];
                $query->where(function ($q) use ($search) {
                    $q->where('full_name', 'LIKE', "%{$search}%")
                        ->orWhere('passport_number', 'LIKE', "%{$search}%")
                        ->orWhere('whatapp_no', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Email',
            'Gender',
            'Date of Birth',
            'WhatsApp No',
            'Alternate Contact',
            'Religion',
            'City',
            'Address',
            'Education',
            'Other Education',
            'Passport Number',
            'English Speaking',
            'Arabic Speaking',
            'Vendor Name',
            'Company Name',
            'Job Title',
            'Job Position (Snapshot)',
            'Job Location',
            'Interview Date (Internal)',
            'Interview Status',
            'Status Remarks',
            'Assigned By',
            'Last Status Updated By',
            'Lineup Created At'
        ];
    }

    public function map($lineup): array
    {
        return [
            $lineup->full_name,
            $lineup->email,
            $lineup->gender,
            $lineup->date_of_birth,
            $lineup->whatapp_no,
            $lineup->alternate_contact_no,
            $lineup->religion,
            $lineup->city,
            $lineup->address,
            $lineup->education,
            $lineup->other_education,
            $lineup->passport_number,
            $lineup->english_speak,
            $lineup->arabic_speak,
            $lineup->vendor->full_name ?? 'N/A',
            $lineup->company->company_name ?? 'N/A',
            $lineup->job->job_name ?? 'N/A',
            $lineup->jobPosition->name ?? 'N/A',
            $lineup->job_location,
            $lineup->date_of_interview,
            $lineup->interview_status ?? 'Pending',
            $lineup->status_remarks ?? 'No remarks',
            $lineup->user->full_name ?? 'N/A',
            $lineup->statusUpdater->full_name ?? 'N/A',
            $lineup->created_at->format('d-m-Y H:i')
        ];
    }
}
