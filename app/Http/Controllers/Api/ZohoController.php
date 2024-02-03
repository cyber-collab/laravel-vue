<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AccountRequest;
use App\Http\Services\ZohoAuthService;
use Illuminate\Support\Facades\Http;
use App\Http\Services\ZohoService;


class ZohoController
{
    public function __construct(private readonly ZohoAuthService $zohoAuthService, private readonly ZohoService $zohoService)
    {
    }

    public function createAccountZoho(array $requestData): string
    {
        return $this->zohoService->createAccount($requestData);
    }

    public function update(array $requestData): void
    {
        $this->zohoService->updateAccount($requestData);
    }

    public function destroy(): void
    {
        //
    }
}
