<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\DealResource;
use App\Models\Deal;

class DealController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return DealResource::collection(Deal::all());
    }

    public function store(DealRequest $request): DealResource
    {
        $deal = Deal::create($request->validated());

        return new DealResource($deal);
    }

    public function show(Deal $deal): DealResource
    {
        return new DealResource($deal);
    }

    public function update(DealRequest $request, Deal $deal): DealResource
    {
        $deal->update($request->validated());

        return new DealResource($deal);
    }

    public function destroy(Deal $deal): Response
    {
        $deal->delete();

        return response()->noContent();
    }
}
