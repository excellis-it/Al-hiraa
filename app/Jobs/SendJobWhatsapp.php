<?php

namespace App\Jobs;

use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CandidateJob;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendJobWhatsapp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $candidate;
    protected $message;

    public function __construct($candidate, $message)
    {
        $this->candidate = $candidate;
        $this->message = $message;
    }

    public function handle()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioPhoneNumber = env('TWILIO_WHATSAPP_NUMBER');

        $twilio = new Client($sid, $token);

        try {
            $twilio->messages->create(
                'whatsapp:' . $this->candidate->whatapp_no,
                [
                    'from' => 'whatsapp:' . $twilioPhoneNumber,
                    'body' => $this->message,
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp message to ' . $this->candidate->whatapp_no . ': ' . $e->getMessage());
        }
    }
}
