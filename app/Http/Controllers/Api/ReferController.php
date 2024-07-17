<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateReferralPoint;
use Illuminate\Support\Facades\Auth;

/**
 * @Refer Job
 */

class ReferController extends Controller
{
    protected $successStatus = 200;

     /**
      * Refer a candidate for a job.
        *
        * This method allows the authenticated user to refer a candidate for a job.
        * If the candidate already exists in the database, the method checks if the candidate
        * has already been referred by the authenticated user. If the candidate has not been
        * referred, a new referral point is created. If the candidate does not exist in the database,
        * a new candidate is created and then referred.
     */
    public function submit(Request $request)
    {
       
        try{
            
            $candidate = Candidate::where('contact_no', $request->phone)->first();
            if ($candidate) {
                // Check if the found candidate is already referred by the current user
                if ($candidate->referred_by_id == Auth::user()->id) {
                    return response()->json(['message' => 'Candidate is already referred by you.', 'status' => false], 409);
                }
            } else {
                $candidate_add = new Candidate();
                $candidate_add->full_name = $request->name;
                $candidate_add->contact_no = $request->phone;
                $candidate_add->referred_by_id = Auth::user()->id;
                $candidate_add->position_applied_for_1 = $request->position_apply;
                $candidate_add->save();
                
                // Return a success response (assuming success status is defined elsewhere)
                return response()->json(['message' => 'Candidate referred successfully.', 'status' => true], 200);
            }
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }

    }

     /**
     * Get total referral points and referral list for the authenticated user.
     *
     * This method fetches the total number of referral points accumulated by the 
     * authenticated user and retrieves a list of all referrals they have made, 
     * including details about the referred candidates and jobs.
     *
     * @param \Illuminate\Http\Request $request The incoming request object.
     * @return \Illuminate\Http\JsonResponse The response containing the total referral points count,
     *                                       the list of referrals, and a status indicator.
     */
    public function totalPoint(Request $request)
    {
        try{
            $total_referral_point = CandidateReferralPoint::where('referrer_candidate_id', Auth::user()->id)->count('refer_point_id');
            $total_referral_list = CandidateReferralPoint::where('referrer_candidate_id', Auth::user()->id)
                ->with(['referCandidate' => function($query) {
                    $query->select('id', 'full_name');
                }])
                ->with(['referJob' => function($query) {
                    $query->select('id', 'job_name');
                }])
                ->get();
            return response()->json(['message' => 'Reffer list fetched successfully.', 'count'=> $total_referral_point,'list' => $total_referral_list,'status' => true], $this->successStatus);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
