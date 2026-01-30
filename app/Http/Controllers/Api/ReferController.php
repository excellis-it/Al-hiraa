<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\ReferCms;
use App\Models\CandidateReferralPoint;
use App\Models\ReferralOtp;
use App\Models\Source;
use App\Services\Coins;
use App\Services\TextlocalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            'phone' => 'required_without:email_id|digits:10|unique:candidates,contact_no',
            'full_name' => 'required',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:candidates,email,' . $request->user()->id,
            'position_applied_for_1' => 'required|exists:candidate_positions,id',
            'position_applied_for_2' => 'nullable|exists:candidate_positions,id',
            'position_applied_for_3' => 'nullable|exists:candidate_positions,id',
            'alternate_contact_no' => 'nullable|digits:10',
            'whatapp_no' => 'nullable|regex:/^\+91\d{10}$/',
            'passport_number' => 'required|regex:/^[A-Za-z]\d{7}$/',
            'gender' => 'nullable|in:MALE,FEMALE,OTHER',
            'date_of_birth' => 'nullable|date_format:d-m-Y',
            'mode_of_registration' => 'nullable|in:CALLING,WALK-IN',
            'education' => 'nullable|in:5TH PASS,8TH PASS,10TH PASS,HIGHER SECONDARY,GRADUATES,MASTERS',
            'other_education' => 'nullable',
            'religion' => 'nullable|in:HINDU,ISLAM,CHRISTIAN,BUDDHIST,SIKH,JAIN,OTHER',
            'ecr_type' => 'nullable|in:ECR,ECNR',
            'english_speak' => 'nullable|in:GOOD,BASIC,POOR,NO',
            'arabic_speak' => 'nullable|in:GOOD,BASIC,POOR,NO',
             'otp' => 'required|numeric|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {

            $referOtp = ReferralOtp::where('user_id', auth()->user()->id)->latest()->where('otp', $request->otp)->first();

            $now = now();
            if (!$referOtp) {
                return response()->json(['message' => 'Invalid OTP.', 'status' => false], 201);
            } elseif ($referOtp && $now->isAfter($referOtp->expire_at)) {
                return response()->json(['message' => 'OTP Expired.', 'status' => false], 201);
            }


            $candidate = Candidate::where('contact_no', $request->phone)->first();
            if ($candidate) {
                // Check if the found candidate is already referred by the current user
                if ($candidate->referred_by_id != '') {
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
                $candidate_add->position_applied_for_1 = $request->position_applied_for_1  ?? null;
                $candidate_add->position_applied_for_2 = $request->position_applied_for_2  ?? null;
                $candidate_add->position_applied_for_3 = $request->position_applied_for_3  ?? null;
                $candidate_add->alternate_contact_no = $request->alternate_contact_no  ?? null;
                $candidate_add->whatapp_no = $request->whatapp_no  ?? null;
                $candidate_add->passport_number = $request->passport_number  ?? null;
                $candidate_add->gender = $request->gender  ?? null;
                $candidate_add->date_of_birth = $request->date_of_birth  ?? null;
                $candidate_add->mode_of_registration = $request->mode_of_registration  ?? null;
                $candidate_add->source = $source->name;
                $candidate_add->education = $request->education  ?? null;
                $candidate_add->other_education = $request->other_education  ?? null;
                $candidate_add->religion = $request->religion  ?? null;
                $candidate_add->ecr_type = $request->ecr_type  ?? null;
                $candidate_add->english_speak = $request->english_speak  ?? null;
                $candidate_add->arabic_speak = $request->arabic_speak  ?? null;
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
                'referCandidate' => function ($query) {
                    $query->select('id', 'full_name', 'contact_no');
                },
                'referJob' => function ($query) {
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
        try {
            $refer_cms = ReferCms::first();
            return response()->json(['message' => 'Refer cms fetched successfully.', 'data' => $refer_cms, 'status' => true], $this->successStatus);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     *
     * Request OTP for referral
     *
     */

    public function requestOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            'full_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false,
            ], 422); // Use 422 for validation errors
        }

        try {

            $candidate = Candidate::where('contact_no', $request->phone)->first();
            if ($candidate) {
                return response()->json([
                    'message' => 'Candidate already exists.',
                    'status' => false,
                ], 200);
            }

            // Generate OTP
            $userOtp = $this->generateOtp($request->phone, $request->full_name);

            if ($userOtp) {
                return response()->json([
                    'message' => 'OTP sent successfully.',
                    'status' => true,
                    'user_id' => $userOtp['user_id'],
                    'otp' => $userOtp['otp'], // Consider removing this in production for security
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed to generate OTP.',
                    'status' => false,
                ], 201);
            }
        } catch (\Exception $e) {
            Log::error('OTP Request Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your request. Please try again.',
                'status' => false,
            ], 401);
        }
    }

    private function generateOtp($mobileNumber, $fullname)
    {

        // Delete existing OTPs for the candidate
        ReferralOtp::where('contact_no', $mobileNumber)->where('user_id', auth()->user()->id)->delete();

        $now = now();
        $otp = rand(100000, 999999);

        // $message = "Hey " . $fullname . ", your OTP " . $otp . " is for verifying the referral from your friend on Al Hiraa. Let’s get started!";

        $message = "Hey " . $fullname . ", your OTP is " . $otp . " to verify the referral from your friend on Al Hiraa. Please do not share this code.";
        $response = app(Coins::class)->sendSms(array($mobileNumber), $message, 1707176977877862702);


        // Check if the SMS was sent successfully
        if (isset($response['error'])) {
            throw new \Exception('Failed to send OTP: ' . $response['error']);
        }

        // Save the OTP in the database
        return ReferralOtp::create([
            'user_id' => auth()->user()->id,
            'otp' => $otp,
            'expire_at' => $now->addMinutes(10),
            'contact_no' => $mobileNumber,
        ]);
    }
}
