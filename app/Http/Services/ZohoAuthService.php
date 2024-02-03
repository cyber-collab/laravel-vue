<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ZohoAuthService
{
    private string $clientId;
    private string  $clientSecret;
    private string  $refreshToken;

    public function __construct()
    {
        $this->clientId = config('zoho.client_id');
        $this->clientSecret = config('zoho.client_secret');
        $this->refreshToken = config('zoho.token');

        $this->ZohoOauth();
    }

    public function ZohoOauth()
    {
        $response = Http::post('https://accounts.zoho.eu/oauth/v2/token?client_id='. $this->clientId . '&client_secret='.$this->clientSecret.'&grant_type=authorization_code'.'&code='. $this->refreshToken);

        return $response;
    }

    public function getAccessToken()
    {
        return Http::post('https://accounts.zoho.eu/oauth/v2/token?refresh_token=1000.60d0bc2e180242508a2ae9abd067b2c3.a7f030b4e36027ab724be17a4f89317e&client_id=' . $this->clientId . '&client_secret=' . $this->clientSecret. '&grant_type=refresh_token');

    }
}
