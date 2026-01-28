<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $sid;
    protected $token;
    protected $from;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->from = config('services.twilio.from');
    }

    public function sendSms($numbers, $message)
    {
        if (empty($this->sid) || empty($this->token) || empty($this->from)) {
            Log::error('Twilio credentials are not set.');
            return ['error' => 'Twilio credentials are not set.'];
        }

        try {
            $twilio = new Client($this->sid, $this->token);

            if (!is_array($numbers)) {
                $numbers = [$numbers];
            }

            $lastResponse = null;
            foreach ($numbers as $number) {
                // Ensure number is in E.164 format.
                // Assuming Indian numbers if 10 digits.
                $formattedNumber = $number;
                if (strlen($number) == 10) {
                    $formattedNumber = '+91' . $number;
                } elseif (strlen($number) == 12 && substr($number, 0, 2) == '91') {
                    $formattedNumber = '+' . $number;
                } elseif (substr($number, 0, 1) != '+') {
                    // fall back or maybe it's already got a country code without +
                    $formattedNumber = '+' . $number;
                }

                $response = $twilio->messages->create(
                    $formattedNumber,
                    [
                        'from' => $this->from,
                        'body' => $message,
                    ]
                );
                $lastResponse = ['status' => 'success', 'sid' => $response->sid];
            }

            return $lastResponse;
        } catch (\Exception $e) {
            Log::error('Twilio SMS Error: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}
