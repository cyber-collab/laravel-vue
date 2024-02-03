<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Http\Controllers\Api\ZohoController;

class AccountService
{
    public function __construct(private readonly ZohoService $zohoService)
    {
    }

    public function createAccount(AccountRequest $request): Account
    {
        $account = Account::create($request->validated());
        $zohoAccountId = $this->zohoService->createAccount($account->toArray());
        $this->setZohoAccountIdToAccount($account, $zohoAccountId);

        return $account;
    }

    public function updateAccount(AccountRequest $request, Account $account): Account
    {
        $account->update($request->validated());
        $accountResource = new AccountResource($account);
        $requestData = $accountResource->toArray($request);
        $this->zohoService->updateAccount($requestData);

        return $account;
    }

    public function deleteAccount(Account $account): void
    {
        $this->zohoService->deleteAccount($account->zoho_record_id);
        $account->delete();
    }

    private function setZohoAccountIdToAccount(Account $account, string $zohoAccountId): void
    {
        $account->update(['zoho_record_id' => $zohoAccountId]);
    }
}
