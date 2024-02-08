<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;

class CandidateOtp extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'otp', 'expire_at'];

    public function sendSMS($receiverNumber)
    {
        $message = "Dear user, your One-Time Password (OTP) for the verification process is: " . $this->otp . ". Please do not share this OTP with anyone for security reasons. Enter this OTP in the required field to proceed. Thank you.";

        try {

            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            info('SMS Sent Successfully.');

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }

}
