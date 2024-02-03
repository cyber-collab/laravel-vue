<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ZohoService
{
    public function __construct(private readonly ZohoAuthService $zohoAuthService)
    {
    }

    public function createAccount(array $requestData): string
    {
        $data = json_encode([
            "data" => [
                [
                    "Account_Name" => $requestData['name'],
                ]
            ]
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])->withBody($data, 'application/json')
            ->post('https://www.zohoapis.eu/crm/v2/Accounts');

        return $response->json()['data'][0]['details']['id'];
    }

    public function updateAccount(array $requestData)
    {
        $data = json_encode(
            array(
                "data" => array([
                    "id" => $requestData['zoho_record_id'],
                    "Account_Name" => $requestData['name'],
                ])
            )
        );

        Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])->withBody($data, 'application/json')
        ->put('https://www.zohoapis.eu/crm/v2/Accounts');
    }
}
