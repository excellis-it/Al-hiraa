<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\ToCollection;

class InterviewJobImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
         //dd(count($rows));
        Validator::make($rows->toArray(), [
            '*.job_name' => 'required',
            '*.duty_hours'=> 'required|numeric',
            '*.contract'=> 'required|numeric',
            '*.salary'=> 'required|numeric',
            '*.quantity_of_people_required'=> 'required|numeric',
            '*.interview_start_date' => 'nullable|date',
            '*.interview_end_date' => 'required|date|after:*.interview_start_date',

        ])->validate();



        foreach ($rows as $row) {
            // $vendorId = Job::where('vendor_id',$row['id']);
            // $vendorId = Job::where('vendor_id', $row['vendor_id'] ?? '');
            //  dd($vendorId);
            $job = new Job();

            // $job->vendor_id = $row['vendor_id'] ?? '';
            $job->status = "Ongoing";
            $job->job_name = $row['job_name'] ?? '';
            $job->duty_hours = $row['duty_hours'] ?? '';
            $job->contract= $row['contract'] ?? '';
            $job->benefits = $row['benefits'] ?? '';
            $job->salary = $row['salary'] ?? '';
            $job->service_charge = $row['service_charge'] ?? '';
            $job->job_description = $row['job_description'] ?? '';
            $job->address = $row['address'] ?? '';
            $job->quantity_of_people_required = $row['quantity_of_people_required'] ?? '';
            $job->vendor_first_name = $row['vendor_first_name'] ?? '';
            $job->vendor_last_name = $row['vendor_last_name'] ?? '';
            $job->vendor_email = $row['vendor_email'] ?? '';
            $job->vendor_service_charge= $row['vendor_service_charge'] ?? '';


            if ($row['interview_start_date']) {
                $interview = new Interview();
                $interview->id = $interview->job_id;
                $interview->interview_start_date = date('d-m-Y', strtotime($row['interview_start_date'])) ?? '';
                $interview->interview_end_date = date('d-m-Y', strtotime($row['interview_end_date'])) ?? '';
                $interview->save();
            }

           //dd($interview);



       // dd($job);

                $count = User::withTrashed()->where('email', $row['vendor_email'])->count();
                //dd($count);
                if ($count > 0) {
                    $user = User::withTrashed()->where('email', $row['vendor_email'])->first();
                    $user->deleted_at = null;
                } else {
                    $user = new User();
                }

                // Set vendor details
                $user->vendor_first_name = $row['vendor_first_name'] ?? '';
                $user->vendor_last_name = $row['vendor_last_name'] ?? '';
                $user->vendor_email = $row['vendor_email'] ?? '';
                //dd($user);

                // Handle VENDOR role code
                if (isset($row['role_type']) && $row['role_type'] == 'VENDOR') {
                    if (!$user->exists || $user->role_type !== 'VENDOR') {
                        // Generate new code for vendors
                        $lastVendor = User::where('role_type', 'VENDOR')->orderBy('id', 'desc')->first();
                        if ($lastVendor) {
                            if ($lastVendor->code == null) {
                                $lastVendor->code = 'AL-VN-00000';
                            }
                            $lastVendorId = explode('-', $lastVendor->code);
                            $vendorId = $lastVendorId[2] + 1;
                            $vendorId = str_pad($vendorId, 5, '0', STR_PAD_LEFT);
                            $user->code = 'AL-VN-' . $vendorId;
                        } else {
                            $user->code = 'AL-VN-00001';
                        }
                    }
                }
                // Save user
                $user->save();

                if (!$user->hasRole($row['role_type'])) {
                    $user->syncRoles([$row['VENDOR']]);
                }
                // $job->vendor_id = $user->id;
                //dd($job);
                $job->save();
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}

