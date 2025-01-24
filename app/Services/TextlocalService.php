<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TextlocalService
{
    protected $apiKey;
    protected $sender;

    public function __construct()
    {
        $this->apiKey = config('services.textlocal.api_key');
        $this->sender = config('services.textlocal.sender_id');
    }

    public function sendSms($numbers, $message)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.textlocal.in/send/';

        // Add '91' prefix to each mobile number
        $formattedNumbers = array_map(function ($number) {
            return '91' . ltrim($number, '0'); // Remove leading '0' if present, and add '91'
        }, $numbers);

        $data = [
            'apikey' => urlencode($this->apiKey), // Make sure `$this->apiKey` is correctly initialized
            'numbers' => implode(',', $formattedNumbers), // Join formatted numbers with commas
            'sender' => urlencode($this->sender), // Ensure `$this->sender` is set with a valid sender name
            'message' => rawurlencode($message),
        ];

        try {
            $response = $client->post($url, [
                'form_params' => $data,
            ]);

            $body = json_decode($response->getBody(), true);

            // Check if the response indicates success
            if (isset($body['status']) && $body['status'] === 'success') {
                return $body; // Return the full response
            } else {
                // Handle any errors returned by the API
                return $body['errors'] ?? ['error' => 'Unknown error occurred'];
            }
        } catch (\Exception $e) {
            // Handle exceptions and log the error message
            return ['error' => $e->getMessage()];
        }
    }
}
