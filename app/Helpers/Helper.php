<?php

namespace App\Helpers;

use App\Models\CandidateFieldUpdate;
use App\Models\IpRestriction;
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
}
