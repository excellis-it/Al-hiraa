<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateReferralPoint;
use Illuminate\Support\Facades\Auth;

class ReferController extends Controller
{
    protected $successStatus = 200;
    //
    public function totalPoint(Request $request)
    {
        try{
            $total_referral_point = CandidateReferralPoint::where('referrer_candidate_id', Auth::user()->id)->count('refer_point_id');
            return response()->json(['message' => 'Profile fetched successfully.', 'data'=> $total_referral_point,'status' => true], $this->successStatus);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
