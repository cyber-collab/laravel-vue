<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\DealResource;
use App\Http\Services\DealService;
use App\Models\Deal;

class DealController extends Controller
{

    public function __construct(
        private readonly DealService $dealService
    )
    {}

    public function index(): AnonymousResourceCollection
    {
        return DealResource::collection(Deal::all());
    }

    public function store(DealRequest $request): DealResource
    {
        $deal = $this->dealService->createDeal($request);

        return new DealResource($deal);
    }

    public function show(Deal $deal): DealResource
    {
        return new DealResource($deal);
    }

    public function update(DealRequest $request, Deal $deal): DealResource
    {
        $deal = $this->dealService->updateDeal($request, $deal);

        return new DealResource($deal);
    }

    public function destroy(Deal $deal): Response
    {
        $this->dealService->deleteDeal($deal);

        return response()->noContent();
    }
}
