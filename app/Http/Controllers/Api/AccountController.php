<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Http\Services\AccountService;

class AccountController extends Controller
{
    public function __construct(
        private readonly AccountService $accountService
    )
    {}

    public function index(): AnonymousResourceCollection
    {
        return AccountResource::collection(Account::all());
    }

    public function store(AccountRequest $request): AccountResource
    {
        $account = $this->accountService->createAccount($request);

        return new AccountResource($account);
    }

    public function show(Account $account): AccountResource
    {
        return new AccountResource($account);
    }

    public function update(AccountRequest $request, Account $account): AccountResource
    {
        $account = $this->accountService->updateAccount($request, $account);

        return new AccountResource($account);
    }

    public function destroy(Account $account): Response
    {
        $this->accountService->deleteAccount($account);

        return response()->noContent();
    }
}
