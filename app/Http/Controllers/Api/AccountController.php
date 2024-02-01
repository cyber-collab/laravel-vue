<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\AccountResource;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AccountResource::collection(Account::all());
    }

    public function store(AccountRequest $request): AccountResource
    {
        $account = Account::create($request->validated());

        return new AccountResource($account);
    }

    public function show(Account $account): AccountResource
    {
        return new AccountResource($account);
    }

    public function update(AccountRequest $request, Account $account): AccountResource
    {
        $account->update($request->validated());

        return new AccountResource($account);
    }

    public function destroy(Account $account): Response
    {
        $account->delete();

        return response()->noContent();
    }
}
