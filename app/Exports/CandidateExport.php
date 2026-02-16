<?php

namespace App\Exports;

use App\Models\Candidate;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CandidateExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading
{
    use Exportable;
    private $startDate;
    private $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


    /**
     * Define the query to retrieve data with relationships.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $start = Carbon::parse($this->startDate)->startOfDay();
        $end   = Carbon::parse($this->endDate)->endOfDay();
        return Candidate::query()
            ->with([
                'lastCandidateActivity',
                'enterBy',
                'candidateStatus',  
                'associatedBy',
                'candidateIndianLicence',
                'candidateGulfLicence',
                'positionAppliedFor1',
                'positionAppliedFor2',
                'positionAppliedFor3'
            ])->whereBetween('created_at', [$start, $end]);
    }

    /**
     * Return the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Date',
            'Remarks',
            'Enter By',
            'Status',
            'Mode of Registration',
            'Source',
            'Last Update Date',
            'Full Name',
            'Gender',
            'DOB',
            'Age',
            'Education',
            'Contact No',
            'Alternate Contact No',
            'Whatsapp No',
            'Email ID',
            'Referred By',
            'Associate By',
            'Other Education',
            'State',
            'City',
            'Religion',
            'ECR Type',
            'Indian Driving License',
            'Gulf Driving License',
            'English Speak',
            'Arabic Speak',
            'Return',
            'Position Applied For(1)',
            'Position Applied For(2)',
            'Position Applied For(3)',
            'Passport Number',
            'Indian Experience',
            'Abroad Experience',
            'Remarks'
        ];
    }

    /**
     * Map each row of data to the export format.
     *
     * @param Candidate $candidate
     * @return array
     */
    public function map($candidate): array
    {
        return [
            date('d.m.Y', strtotime($candidate->created_at)) ?? 'N/A',
            $candidate->lastCandidateActivity->remarks ?? 'N/A',
            $candidate->enterBy->full_name ?? 'N/A',
            $candidate->candidateStatus->name ?? 'N/A',
            $candidate->mode_of_registration ?? 'N/A',
            $candidate->source ?? 'N/A',
            date('d.m.Y', strtotime($candidate->last_update_date)) ?? 'N/A',
            $candidate->full_name ?? 'N/A',
            $candidate->gender ?? 'N/A',
            date('d.m.Y', strtotime($candidate->date_of_birth)) ?? 'N/A',
            \Carbon\Carbon::parse($candidate->date_of_birth)->age ?? 'N/A',
            $candidate->education ?? 'N/A',
            $candidate->contact_no ?? 'N/A',
            $candidate->alternate_contact_no ?? 'N/A',
            $candidate->whatapp_no ?? 'N/A',
            $candidate->email ?? 'N/A',
            $candidate->referred_by ?? 'N/A',
            $candidate->associatedBy->full_name ?? 'N/A',
            $candidate->other_education ?? 'N/A',
            $candidate->state->name ?? 'N/A',
            $candidate->cityName->name ?? 'N/A',
            $candidate->religion ?? 'N/A',
            $candidate->ecr_type ?? 'N/A',
            $this->getLicences($candidate->candidateIndianLicence),
            $this->getLicences($candidate->candidateGulfLicence),
            $candidate->english_speak ?? 'N/A',
            $candidate->arabic_speak ?? 'N/A',
            $candidate->return == 1 ? 'Yes' : 'No',
            $candidate->positionAppliedFor1->name ?? 'N/A',
            $candidate->positionAppliedFor2->name ?? 'N/A',
            $candidate->positionAppliedFor3->name ?? 'N/A',
            $candidate->passport_number ?? 'N/A',
            $candidate->indian_exp ?? 'N/A',
            $candidate->abroad_exp ?? 'N/A',
            $candidate->lastCandidateActivity->remarks ?? 'N/A',
        ];
    }

    /**
     * Get formatted license information.
     *
     * @param $licences
     * @return string
     */
    private function getLicences($licences)
    {
        if (count($licences) > 0) {
            return implode(', ', $licences->pluck('licence_name')->toArray());
        }

        return 'N/A';
    }

    /**
     * Specify the chunk size for export.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000; // Customize chunk size as per your requirement
    }
}
