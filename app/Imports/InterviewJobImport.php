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
        $errors = [];

        // Perform validation on the entire dataset before processing
        $validator = Validator::make($rows->toArray(), [
            '*.position' => 'required',
            '*.vendor_email' =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
            '*.service_charge' => 'required|numeric',
            '*.job_name' => 'required',
            '*.contract' => 'nullable|numeric',
            '*.address' => 'required',
            '*.salary' => 'required|numeric',
            '*.duty_hours' => 'numeric',
            '*.quantity_of_people_required' => 'required|numeric',
            '*.interview_start_date' => 'required|date',
            '*.interview_end_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            // Capture and log validation errors
            foreach ($validator->errors()->getMessages() as $key => $error) {
                $errors[$key] = $error;
            }
            return $errors;
        }

        foreach ($rows as $key => $row) {
            $vendor = User::role('VENDOR')->where('email', $row['vendor_email'])->first();

            // If vendor not found, log the error and skip to the next row
            if (!$vendor) {
                $errors[$key]['vendor_email'] = "Vendor with email {$row['vendor_email']} not found.";
                continue;
            }

            // Check or create position
            $position = CandidatePosition::firstOrCreate(
                ['name' => $row['position']],
                ['user_id' => auth()->id(), 'is_active' => 1]
            );
            $position_id = $position->id;

            // Create job record
            $job = new Job();
            $job->status = "Ongoing";
            $job->job_name = $row['job_name'] ?? '';
            $job->company_id = $this->company_id;
            $job->contract = $row['contract'] ?? '';
            $job->benifits = $row['benifits'] ?? '';
            $job->salary = $row['salary'] ?? '';
            $job->service_charge = $row['service_charge'] ?? '';
            $job->job_description = $row['job_description'] ?? '';
            $job->duty_hours = $row['duty_hours'] ? $row['duty_hours'] : '';
            $job->address = $row['address'] ?? '';
            $job->quantity_of_people_required = $row['quantity_of_people_required'] ?? '';
            $job->vendor_id = $vendor->id;
            $job->candidate_position_id = $position_id;
            $job->save();

            // Create interview record if dates are provided
            if ($row['interview_start_date'] && $row['interview_end_date']) {
                Interview::create([
                    'job_id' => $job->id,
                    'user_id' => auth()->id(),
                    'company_id' => $this->company_id,
                    'interview_start_date' => date('Y-m-d', strtotime($row['interview_start_date'])),
                    'interview_end_date' => date('Y-m-d', strtotime($row['interview_end_date']))
                ]);
            }
        }

        return $errors ?: 'Processing completed successfully';
    }

    public function headingRow(): int
    {
        return 1;
    }
}
