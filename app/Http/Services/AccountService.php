<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Http\Services\ZohoServices\ZohoAccountService;

class AccountService
{
    public function __construct(private readonly ZohoAccountService $zohoAccountService)
    {
    }

    public function createAccount(AccountRequest $request): Account
    {
        $account = Account::create($request->validated());
        $zohoAccountId = $this->zohoAccountService->createZohoAccount($account->toArray());
        $this->setZohoAccountIdToAccount($account, $zohoAccountId);

        return $account;
    }

    public function updateAccount(AccountRequest $request, Account $account): Account
    {
        $account->update($request->validated());
        $accountResource = new AccountResource($account);
        $requestData = $accountResource->toArray($request);
        $this->zohoAccountService->updateZohoAccount($requestData);

        return $account;
    }

    public function deleteAccount(Account $account): void
    {
        $this->zohoAccountService->deleteZohoAccount($account->zoho_record_id);
        $account->delete();
    }

    private function setZohoAccountIdToAccount(Account $account, string $zohoAccountId): void
    {
        $account->update(['zoho_record_id' => $zohoAccountId]);
    }
}
