<?php

namespace App\Jobs;

use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Candidate;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendJobSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $candidate;
    protected $message;
    /**
     * Create a new job instance.
     */
    public function __construct($candidate, $message)
    {
        $this->candidate = $candidate;
        $this->message = $message;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
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
}
