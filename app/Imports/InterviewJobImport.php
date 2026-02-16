<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\User;
use App\Models\Interview;
use App\Models\CandidatePosition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class InterviewJobImport implements ToCollection, WithHeadingRow
{
    protected $company_id;

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows = $rows->filter(function ($row) {
            return array_filter($row->toArray());
        });

        $cleanedRows = $rows->map(function ($row) {
            $row['interview_start_date'] = $this->formatExcelDate($row['interview_start_date']);
            return $row;
        });

        // Now validate the cleaned rows
        $validator = Validator::make($cleanedRows->toArray(), [
            '*.position' => 'required',
            '*.service_charge' => 'required|numeric',
            '*.job_name' => 'required',
            '*.contract' => 'nullable|numeric',
            '*.location' => 'required',
            '*.interview_location' => 'required',
            '*.salary' => 'required',
            '*.duty_hours' => 'nullable|numeric',
            '*.benifits' => 'nullable',
            '*.associate_charge' => 'required|numeric',
            '*.quantity_of_people_required' => 'required|numeric',
            '*.interview_start_date' => 'required|date|after_or_equal:today',
        ]);

        $validator->validate();

        foreach ($cleanedRows as $key => $row) {
            $interview_start_date = $row['interview_start_date'];
            $interview_end_date = $row['interview_start_date'];

            $vendor = null;
            if (!empty($row['vendor_email'])) {
                $vendor = User::role('VENDOR')->where('email', $row['vendor_email'])->first();
                if (!$vendor) {
                    $errors[$key]['vendor_email'] = "Vendor with email {$row['vendor_email']} not found.";
                    // passed the vendor email with validation error
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'vendor_email' => ["Vendor with email {$row['vendor_email']} not found."]
                    ]);
                }
            }

            $position = CandidatePosition::firstOrCreate(
                ['name' => $row['position']],
                ['user_id' => auth()->id(), 'is_active' => 1]
            );

            $year = date('Y');
            $last_job_this_year = Job::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
            $last_entry_number = $last_job_this_year && $last_job_this_year->job_id
                ? (int) explode('/', $last_job_this_year->job_id)[1] ?? 0
                : 0;

            $new_entry_number = str_pad($last_entry_number + 1, 3, '0', STR_PAD_LEFT);
            $service_charge = $row['service_charge'];
            $new_job_id = "{$year}/{$new_entry_number}/{$service_charge}";

            $job = new Job();
            $job->status = "Ongoing";
            $job->job_id = $new_job_id;
            $job->job_name = $row['job_name'] ?? null;
            $job->company_id = $this->company_id;
            $job->contract = $row['contract'] ?? null;
            $job->benifits = $row['benifits'] ?? null;
            $job->salary = $row['salary'] ?? null;
            $job->service_charge = $row['service_charge'] ?? null;
            $job->associate_charge = $row['associate_charge'] ?? null;
            $job->job_description = $row['job_description'] ?? null;
            $job->duty_hours = $row['duty_hours'] ?? null;
            $job->address = $row['location'] ?? null;
            $job->quantity_of_people_required = $row['quantity_of_people_required'] ?? null;
            $job->vendor_id = $vendor->id ?? null;
            $job->candidate_position_id = $position->id;
            $job->save();

            $interview = new Interview();
            $interview->job_id = $job->id;
            $interview->user_id = auth()->id();
            $interview->interview_location = $row['interview_location'];
            $interview->company_id = $this->company_id;
            $interview->interview_start_date = $interview_start_date;
            $interview->interview_end_date = $interview_end_date;
            $interview->interview_id = $interview->generateInterviewId();
            $interview->save();
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
