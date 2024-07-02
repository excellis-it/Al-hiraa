<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateOtp;
use App\Models\CandidatePosition;
use App\Models\Notification;
use App\Mail\SendUserOtp;
use Illuminate\Support\Facades\Mail;
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
            'mobile_number' => 'required_without:email_id|digits:10|exists:candidates,contact_no',
            'email_id' => 'required_without:mobile_number|email|exists:candidates,email'
        ]);



        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 201);
        }

        try {
            $userOtp = null;
            if($request->mobile_number){
                $userOtp = $this->generateOtp($request->mobile_number);
            }else{
                $userOtp = $this->generateOtp($request->email_id);
            }
            // return $userOtp;
            //if mobile number get then sendsms code will be executed otherwise mail send
            if ($userOtp) {
                if($request->mobile_number){
                    // $userOtp->sendSMS($request->mobile_number);
                }else{
                    Mail::to($request->email_id)->send(new SendUserOtp($userOtp));

                }
                return response()->json(['message' => 'OTP sent successfully.', 'status' => true, 'user_id' => $userOtp->user_id], 200);
            } else {
                return response()->json(['message' => 'Failed to send OTP.', 'status' => false], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    private function generateOtp($value)
    {
        if ($value) {
            $candidate = Candidate::where('contact_no', $value)->orWhere('email', $value)->first();
        }


        // $candidate = Candidate::where('contact_no', $value)->first();

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
     * @bodyParam otp integer required 6 digit OTP. Example: 123456
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
            } else {
                return response()->json(['message' => 'User not found.', 'status' => false], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     * Register User
     *
     * This endpoint will be used to register a new user.
     * @bodyParam full_name string required Full Name of the user. Example: John Doe
     * @bodyParam contact_no integer required Contact Number of the user. Example: 9876543210
     * @bodyParam job_interest array required Array of job interests. Example: ["Job 1", "Job 2", "Job 3"]
     * @bodyParam otp integer required 6 digit OTP. Example: 123456
     * @response {
     * "message": "User registered successfully."
     * }
     * @response 201 {
     * "message": "The contact no has already been taken.",
     * "status": false
     * }
     *
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'contact_no' => 'required|digits:10|unique:candidates,contact_no',
            'job_interest' => 'required|array|min:1|max:3',
            'otp' => 'required|numeric|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            $candidateOtp = CandidateOtp::where('user_id', $request->user_id)->latest()->where('otp', $request->otp)->first();

            $now = now();

            if (!$candidateOtp) {
                return response()->json(['message' => 'Invalid OTP.', 'status' => false], 201);
            } elseif ($candidateOtp && $now->isAfter($candidateOtp->expire_at)) {
                return response()->json(['message' => 'OTP Expired.', 'status' => false], 201);
            } else {
                $candidate = new Candidate();
                $candidate->full_name = $request->full_name;
                $candidate->contact_no = $request->contact_no;
                $candidate->position_applied_for_1 = $request->job_interest[0]  ?? null;
                $candidate->position_applied_for_2 = $request->job_interest[1]  ?? null;
                $candidate->position_applied_for_3 = $request->job_interest[2]  ?? null;
                $candidate->cnadidate_status_id = 1;
                $candidate->save();

                $notification = new Notification;
                $notification->candidate_id = $candidate->id;
                $notification->type = 'Login';
                $notification->message = 'Congrats! You now have your professional website!';
                $notification->save();

                $candidateOtp->update(['expire_at' => $now]);
                $candidate['token'] = $candidate->createToken('accessToken')->accessToken;
                return response()->json(['message' => 'User registered successfully.', 'status' => true, 'candidate' => $candidate], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     * Request OTP for Register
     */

    public function requestOtpRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric|digits:10|unique:candidates,contact_no'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            $userOtp = $this->generateOtpRegister($request->mobile_number);
            if ($userOtp) {
                $userOtp->sendSMS($request->mobile_number);
                return response()->json(['message' => 'OTP sent successfully.', 'status' => true, 'mobile_number' => $request->mobile_number], 200);
            } else {
                return response()->json(['message' => 'Failed to send OTP.', 'status' => false], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    private function generateOtpRegister($mobileNumber)
    {
        /*User Does not Have any Existing OTP*/
        CandidateOtp::where('contact_no', $mobileNumber)->delete();

        $now = now();

        $otp = rand(100000, 999999);

        return CandidateOtp::create([
            'contact_no' => $mobileNumber,
            'otp' => $otp,
            'expire_at' => $now->addMinutes(10)
        ]);
    }

    /**
     * Job Interest
     *
     * This endpoint will be used to update job interest of the user.
     * @bodyParam job_interest array required Array of job interests. Example: ["Job 1", "Job 2", "Job 3"]
     * @response {
     * "message": "Job interest updated successfully."
     * }
     */

    public function jobInterest(Request $request)
    {
        try {
            $candidate_position = CandidatePosition::where('is_active', 1)->get();
            if ($candidate_position) {
                return response()->json(['message' => 'Job interest updated successfully.', 'status' => true, 'data' => $candidate_position], 200);
            } else {
                return response()->json(['message' => 'Failed to update job interest.', 'status' => false], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
