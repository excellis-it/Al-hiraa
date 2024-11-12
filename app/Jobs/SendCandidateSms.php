<?php

namespace App\Jobs;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SendCandidateSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $candidate;
    protected $message;

    public function __construct(Candidate $candidate, $message)
    {
        $this->candidate = $candidate;
        $this->message = $message;
    }

    public function handle()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioPhoneNumber = env('TWILIO_FROM');

        $twilio = new Client($sid, $token);

        try {
            $twilio->messages->create(
                '+91' . $this->candidate->contact_no,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $this->message,
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to send SMS to ' . $this->candidate->contact_no . ': ' . $e->getMessage());
        }
    }

    // public function handle()
    // {
    //     $apiKey = env('TEXTLOCAL_API_KEY');

    //     $number = $this->candidate->contact_no;
    //     $message = $this->message;

    //     $sender = urlencode('TXTLCL');
    //     $message = rawurlencode($this->message);

    //     $data = array(
    //         'apikey' => $apiKey,
    //         'numbers' => $number,
    //         'message' => $message,
    //         'sender' => $sender
    //     );


    //     $ch = curl_init('https://api.textlocal.in/send/');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     Log::info('SMS sent to ' . $this->candidate->contact_no . ': ' . $response);
    // }
}
