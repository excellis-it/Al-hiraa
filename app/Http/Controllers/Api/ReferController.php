<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\ReferCms;
use App\Models\CandidateReferralPoint;
use App\Models\Source;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required_without:email_id|digits:10|unique:candidates,contact_no',
            'position_apply' => 'required|array|min:1|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try{

            $candidate = Candidate::where('contact_no', $request->phone)->first();
            if ($candidate) {
                // Check if the found candidate is already referred by the current user
                if ($candidate->referred_by_id !='') {
                    return response()->json(['message' => 'Candidate is already referred', 'status' => false], 200);
                }
            } else {
                $sourceCount = Source::where('name', 'MOBILE')->count();
                if ($sourceCount == 0) {
                    $source = new Source();
                    $source->name = 'MOBILE';
                    $source->save();
                } else {
                    $source = Source::where('name', 'MOBILE')->first();
                }

                $candidate_add = new Candidate();
                $candidate_add->cnadidate_status_id = 1;
                $candidate_add->full_name = $request->name;
                $candidate_add->contact_no = $request->phone;
                $candidate_add->referred_by_id = Auth::user()->id;
                $candidate_add->refer_name = Auth::user()->full_name;
                $candidate_add->refer_phone = Auth::user()->contact_no;
                $candidate_add->position_applied_for_1 = $request->position_apply[0]  ?? null;
                $candidate_add->position_applied_for_2 = $request->position_apply[1]  ?? null;
                $candidate_add->position_applied_for_3 = $request->position_apply[2]  ?? null;
                $candidate_add->source = $source->name;
                $candidate_add->enter_by = 0;
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
        $limit = $request->limit ?? 10;
        $offset = $request->offset ?? 0;

        try {
            $total_referral = CandidateReferralPoint::where('referrer_candidate_id', Auth::user()->id)->count();
            $total_referral_point = CandidateReferralPoint::where('referrer_candidate_id', Auth::user()->id)->sum('refer_point');

            $referrals = CandidateReferralPoint::query();
            $referrals = $referrals->where('referrer_candidate_id', Auth::user()->id);

            // Apply single search filter if present
            if ($request->search) {
                $search = $request->search;
                $referrals = $referrals->where(function ($query) use ($search) {
                    $query->whereHas('referCandidate', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%');
                    })->orWhereHas('referJob', function ($query) use ($search) {
                        $query->where('job_name', 'like', '%' . $search . '%');
                    });
                });
            }

            // Pagination
            $referrals = $referrals->with([
                'referCandidate' => function($query) {
                    $query->select('id', 'full_name', 'contact_no');
                },
                'referJob' => function($query) {
                    $query->select('id', 'job_name');
                }
            ])->offset($offset)->limit($limit)->get();

            return response()->json([
                'message' => 'Referral list fetched successfully.',
                'refer_point_count' => $total_referral_point,
                'total_refer' => $total_referral,
                'list' => $referrals,
                'status' => true
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 401);
        }


    }

    /**
     * View refer cms
     *
     */

    public function view()
    {
        try{
            $refer_cms = ReferCms::first();
            return response()->json(['message' => 'Refer cms fetched successfully.', 'data' => $refer_cms, 'status' => true], $this->successStatus);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
