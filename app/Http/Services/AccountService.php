<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Http\Controllers\Api\ZohoController;

class AccountService
{
    public function __construct(private readonly ZohoController $zohoController)
    {
    }

    public function createAccount(AccountRequest $request): Account
    {
        $account = Account::create($request->validated());
        $zohoAccountId = $this->zohoController->createAccountZoho($account->toArray());
        $this->setZohoAccountIdToAccount($account, $zohoAccountId);

        return $account;
    }

    public function updateAccount(AccountRequest $request, Account $account): Account
    {
        $account->update($request->validated());
        $accountResource = new AccountResource($account);
        $requestData = $accountResource->toArray($request);
        $this->zohoController->update($requestData);

        return $account;
    }

    private function setZohoAccountIdToAccount(Account $account, string $zohoAccountId): void
    {
        $account->update(['zoho_record_id' => $zohoAccountId]);
    }
}
