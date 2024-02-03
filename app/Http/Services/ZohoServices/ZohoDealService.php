<?php

namespace App\Http\Services\ZohoServices;

use App\Models\Account;
use Illuminate\Support\Facades\Http;

class ZohoDealService
{
    public function __construct(private readonly ZohoAuthService $zohoAuthService)
    {
    }

    private function getAccountNameById($accountId): string
    {
        $account = Account::find($accountId);

        if ($account) {
            return $account->name;
        }

        return null;
    }

    public function createZohoDeal(array $requestData): string
    {
        $data = json_encode([
            "data" => [
                [
                    "Deal_Name" => $requestData['deal_name'],
                    "Closing_Date" => $requestData['closing_date'],
                    "Account_Name" => $this->getAccountNameById($requestData['account_id']),
                    "Stage" => "Qualification"
                ]
            ]
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])->withBody($data, 'application/json')
            ->post('https://www.zohoapis.eu/crm/v2/Deals');

        return $response->json()['data'][0]['details']['id'];
    }

    public function updateZohoDeal(array $requestData)
    {
        $data = json_encode([
            "data" => [
                [
                    "id" => $requestData['zoho_record_id'],
                    "Deal_Name" => $requestData['deal_name'],
                    "Closing_Date" => $requestData['closing_date'],
                    "Account_Name" => $this->getAccountNameById($requestData['account_id']),
                    "Stage" => "Qualification"
                ]
            ]
        ]);

        Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])->withBody($data, 'application/json')
        ->put('https://www.zohoapis.eu/crm/v2/Deals');
    }

    public function deleteZohoAccount(int $id)
    {
      Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Zoho-oauthtoken ' . $this->zohoAuthService->getAccessToken()->json()['access_token'],
        ])
        ->delete('https://www.zohoapis.eu/crm/v2/Deals?ids=' . $id);
    }
}
