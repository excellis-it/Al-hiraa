<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Coins
{
    protected $apiKey;
    protected $peid;
    protected $mask;
    protected $mtype;

    public function __construct()
    {
        $this->apiKey = config('services.coins.api_key');
        $this->peid = config('services.coins.peid');
        $this->mask = config('services.coins.mask');
        $this->mtype = config('services.coins.mtype');
    }



    public function sendSms($numbers, $message, $tempid)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.100coins.co/v3/getsms';

        // Add '91' prefix to each mobile number
        $formattedNumbers = array_map(function ($number) {
            return '91' . ltrim($number, '0'); // Remove leading '0' if present, and add '91'
        }, $numbers);

        $data = [
            'apikey' => $this->apiKey,
            'mtype' => $this->mtype,
            'mask' => $this->mask,
            'mobno' => $formattedNumbers[0],
            'message' => $message,
            'tempid' => $tempid,
            'peid' => $this->peid
        ];

        Log::info('Coins SMS Data:', $data);

        try {
            $response = $client->get($url, [
                'query' => $data,
            ]);

            $body = json_decode($response->getBody(), true);

            // Check if the response indicates success
            if (isset($body['ecode']) && $body['ecode'] === '000') {
                return $body; // Return the full response which includes 'ecode', 'description', 'smsid'
            } else {
                return [
                    'error' => $body['description'] ?? 'Unknown error occurred',
                    'ecode' => $body['ecode'] ?? null,
                    'full_response' => $body
                ];
            }
        } catch (\Exception $e) {
            // Handle exceptions and log the error message
            Log::info(' SMS Error: ' . json_encode($e->getMessage()));
            return ['error' => $e->getMessage()];
        }
    }
}
