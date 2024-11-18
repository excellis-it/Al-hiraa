<?php

namespace App\Helpers;

use App\Models\CandidateFieldUpdate;
use App\Models\IpRestriction;
use app\Models\User;
use App\Models\CandidateJob;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{

    public static function getAge($date)
    {
        return Carbon::parse($date)->age;
    }

    public static function getUpdatedData($candidate_id, $user_id)
    {
        $candidate_updated = CandidateFieldUpdate::where('candidate_id', $candidate_id)->where('user_id', $user_id)->orderBy('id', 'desc')->first();
        if ($candidate_updated) {
            return $candidate_updated;
        } else {
            return [];
        }
    }

    public static function ipCheck($ipAddress)
    {
        $ipRestriction = IpRestriction::where('ip_address', $ipAddress)->where('is_active', true)->first();
        if ($ipRestriction) {
            return true;
        } else {
            return false;
        }
    }

    public static function userRole($id)
    {
        $user = User::find($id);
        if ($user) {
            $roleNames = $user->getRoleNames(); // This is an array of role names
            if ($roleNames->isEmpty()) {
                return null; // Or some default value if no roles are found
            } else {
                return $roleNames->first(); // Return the first role name
            }
        } else {
            return null;
        }
    }

    public static function interviewSchedule($id = null)
    {

        $interviewSchedule = CandidateJob::where('assign_by_id', $id)->where('date_of_interview', '!=', null)->count();
        if ($interviewSchedule) {
            return $interviewSchedule;
        } else {
            return 0;
        }
    }

    public static function interviewAppear($id = null)
    {
        $interviewAppear = CandidateJob::where('assign_by_id', $id)->where('deployment_date', '!=', null)->count();
        if ($interviewAppear) {
            return $interviewAppear;
        } else {
            return 0;
        }
    }

    public static function getRcInterestedCount($interview_id)
    {
        return CandidateJob::where('interview_id', $interview_id)->where('assign_by_id', auth()->id())->count();
    }

    public static function getCurrentStatus($job_id)
    {
        $candidate_job_details = CandidateJob::where('id', $job_id)->first();

        // Status array with corresponding labels
        $status = [
            'Deployment' => ($candidate_job_details->deployment_date != null),
            'Collection' => ($candidate_job_details->total_amount != null),
            'Document' => ($candidate_job_details->visa_receiving_date != null),
            'Medical' => ($candidate_job_details->medical_status != null),
            'Selected' => ($candidate_job_details->job_interview_status == 'Selected'),
            'Interview' => ($candidate_job_details->job_interview_status == 'Interested' || $candidate_job_details->job_interview_status == 'Selected'), // Added 'Interested' status
        ];

        // Return the last true status
        foreach ($status as $key => $value) {
            if ($value) {
                return $key;
            }
        }

        // Return 'No Status' if none of the conditions are met
        return 'No Status';
    }

    public static function getInterviewReport($type, $company_id, $month, $year)
    {
        $query = CandidateJob::where('company_id', $company_id)
            ->whereYear('created_at', $year) // Assuming you're filtering based on the 'created_at' timestamp
            ->whereMonth('created_at', $month); // Use the correct date column

        if ($type == 'Interested') {
            $count = $query->where(function ($query) {
                $query->where('job_interview_status', 'Interested')
                    ->orWhere('job_interview_status', 'Selected');
            })->count();
        } elseif ($type == 'Selected') {
            $count = $query->where('job_interview_status', 'Selected')->count();
        } elseif ($type == 'Medical') {
            $count = $query->whereNotNull('medical_status')->count();
        } elseif ($type == 'Documentaion') {
            $count = $query->whereNotNull('visa_receiving_date')->count();
        } elseif ($type == 'Deployment') {
            $count = $query->whereNotNull('deployment_date')->count();
        } elseif ($type == 'Total Collection') {

            // $count = $query->sum('fst_installment_amount') +
            //     $query->sum('secnd_installment_amount') +
            //     $query->sum('third_installment_amount') +
            //     $query->sum('fourth_installment_amount');
            $jobs = $query->where('medical_status', 'FIT')->get();
            $count = $jobs->sum('fst_installment_amount') +
                $jobs->sum('secnd_installment_amount') +
                $jobs->sum('third_installment_amount') +
                $jobs->sum('fourth_installment_amount');
        } elseif ($type == 'Vendor Service Charge') {
            $count = $query->where('medical_status', 'FIT')->sum('vendor_service_charge');
        } elseif ($type == 'Pending Collection') {
            $jobs = $query->where('medical_status', 'FIT')->get();
            $total_service_charge = $jobs->sum(function ($job) {
                return $job->jobTitle ? $job->jobTitle->service_charge : 0;
            });

            $fst_installment_amount = $query->sum('fst_installment_amount') ?? 0;
            $secnd_installment_amount = $query->sum('secnd_installment_amount') ?? 0;
            $third_installment_amount = $query->sum('third_installment_amount') ?? 0;
            $fourth_installment_amount = $query->sum('fourth_installment_amount') ?? 0;

            $count = $total_service_charge - ($fst_installment_amount + $secnd_installment_amount + $third_installment_amount + $fourth_installment_amount);
        } elseif ($type == 'Total Service Charge') {
            $jobs = $query->where('medical_status', 'FIT')->get();
            $count = $jobs->sum(function ($job) {
                return $job->jobTitle ? $job->jobTitle->service_charge : 0;
            });
        } else {
            $count = 0;
        }

        return $count;
    }
}
