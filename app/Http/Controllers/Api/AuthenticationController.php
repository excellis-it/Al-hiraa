<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Authentication
 */
class AuthenticationController extends Controller
{
    protected $successStatus = 200;

    /**
     * Request OTP
     *
     * This endpoint will be used to request OTP for login.
     *
     * @bodyParam mobile_number integer required Mobile Number of the user. Example: 9876543210
     *
     * @response {
     *  "message": "OTP sent successfully."
     * }
     */

    public function requestOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|exists:candidates,contact_no'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            $userOtp = $this->generateOtp($request->mobile_number);
            if ($userOtp) {
                $userOtp->sendSMS($request->mobile_number);
                return response()->json(['message' => 'OTP sent successfully.', 'status' => true, 'user_id' => $userOtp->user_id], 200);
            } else {
                return response()->json(['message' => 'Failed to send OTP.', 'status' => false], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 201);
        }
    }

    private function generateOtp($mobileNumber)
    {
        // return $mobileNumber;
        $candidate = Candidate::where('contact_no', $mobileNumber)->first();

        /*User Does not Have any Existing OTP*/
        CandidateOtp::where('user_id', $candidate->id)->delete();

        $now = now();

        $otp = rand(100000, 999999);

        return CandidateOtp::create([
            'user_id' => $candidate->id,
            'otp' => $otp,
            'expire_at' => $now->addMinutes(10)
        ]);
    }

    /**
     * Login
     *
     * This endpoint will be used to verify the OTP for login.
     * @bodyParam user_id integer required User ID of the user. Example: 1
     * @bodyParam otp integer required OTP received by the user. Example: 1234
     * @response {
     * "message": "OTP verified successfully."
     * }
     */


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:candidates,id',
            'otp' => 'required|numeric|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            // validation logic
            $candidateOtp = CandidateOtp::where('user_id', $request->user_id)->latest()->where('otp', $request->otp)->first();

            $now = now();
            if (!$candidateOtp) {
                return response()->json(['message' => 'Invalid OTP.', 'status' => false], 201);
            } elseif ($candidateOtp && $now->isAfter($candidateOtp->expire_at)) {
                return response()->json(['message' => 'OTP Expired.', 'status' => false], 201);
            }

            $candidate = Candidate::find($request->user_id);
            if ($candidate) {
                $candidateOtp->update(['expire_at' => $now]);
                $token = $candidate->createToken('accessToken')->accessToken;
                return response()->json(['message' => 'OTP verified successfully.', 'status' => true, 'token' => $token], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 201);
        }
    }
}
