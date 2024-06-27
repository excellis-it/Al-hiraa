<?php

namespace App\Helpers;

use App\Models\CandidateFieldUpdate;
use App\Models\IpRestriction;
use app\Models\User;
use App\Models\CandidateJob;
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
        $candidate_updated = CandidateFieldUpdate::where('candidate_id', $candidate_id)->where('user_id', $user_id)->first();
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
        $interviewAppear = CandidateJob::where('assign_by_id', $id)->where('deployment_date', '!=',null)->count();
        if ($interviewAppear) {
            return $interviewAppear;
        } else {
            return 0;
        }
    }
   

}
