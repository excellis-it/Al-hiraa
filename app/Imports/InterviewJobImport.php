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
        // $errors = [];

        // Perform validation on the entire dataset before processing
        $validator = Validator::make($rows->toArray(), [
            '*.position' => 'required',
            '*.vendor_email' =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
            '*.service_charge' => 'required|numeric',
            '*.job_name' => 'required',
            '*.contract' => 'nullable|numeric',
            '*.location' => 'required',
            '*.salary' => 'required|numeric',
            '*.duty_hours' => 'numeric',
            '*.quantity_of_people_required' => 'required|numeric',
            '*.interview_start_date' => 'required|date|after_or_equal:today',
            '*.interview_end_date' => 'required|date|after_or_equal:*.interview_start_date',
        ], [
            'vendor_email.exists' => 'Please provide a valid vendor email from the system.',
            'interview_start_date.after_or_equal' => 'The interview start date must be a date after or equal to today.',
            'interview_end_date.after_or_equal' => 'The interview end date must be a date after or equal to the interview start date.',
            'position.required' => 'Position is required',
            'vendor_email.required' => 'Vendor email is required',
            'service_charge.required' => 'Service charge is required',
            'job_name.required' => 'Job name is required',
            'contract.required' => 'Contract is required',
            'location.required' => 'Location is required',
            'salary.required' => 'Salary is required',
            'duty_hours.required' => 'Duty hours is required',
            'quantity_of_people_required.required' => 'Quantity of people required is required',
            'interview_start_date.required' => 'Interview start date is required',
            'interview_end_date.required' => 'Interview end date is required'
        ])->validate();

        // dd($rows);

        // if ($validator->fails()) {
        //     // Capture and log validation errors
        //     foreach ($validator->errors()->getMessages() as $key => $error) {
        //         $errors[$key] = $error;
        //     }
        //     return $errors;
        // }

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
            $job->address = $row['location'] ?? '';
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

        // return $errors ?: 'Processing completed successfully';
    }

    public function headingRow(): int
    {
        return 1;
    }
}
