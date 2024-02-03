<?php

namespace App\Http\Services\ZohoServices;

use Illuminate\Support\Facades\Http;

class ZohoAccountService
{
    public function __construct(private readonly ZohoAuthService $zohoAuthService)
    {
    }

    public function createZohoAccount(array $requestData): string
    {
        $data = json_encode([
            "data" => [
                [
                    "Account_Name" => $requestData['name'],
                    "Phone" => $requestData['phone'],
                    "Website" => $requestData['website']
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

    public function updateZohoAccount(array $requestData)
    {
        $data = json_encode(
            array(
                "data" => array([
                    "id" => $requestData['zoho_record_id'],
                    "Account_Name" => $requestData['name'],
                    "Phone" => $requestData['phone'],
                    "Website" => $requestData['website']
                ])
            )
        );

        Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])->withBody($data, 'application/json')
        ->put('https://www.zohoapis.eu/crm/v2/Accounts');
    }

    public function deleteZohoAccount(int $id)
    {
      Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])
        ->delete('https://www.zohoapis.eu/crm/v2/Accounts?ids=' . $id);
    }
}
