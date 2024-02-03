<?php

namespace App\Http\Services;

use App\Models\Deal;
use App\Http\Requests\DealRequest;
use App\Http\Resources\DealResource;
use App\Http\Services\ZohoServices\ZohoDealService;

class DealService
{
    public function __construct(private readonly ZohoDealService $zohoDealService)
    {
    }

    public function createDeal(DealRequest $request): Deal
    {
        $deal = Deal::create($request->validated());
        $zohodealId = $this->zohoDealService->createZohoDeal($deal->toArray());
        $this->setZohoDealIdToAccount($deal, $zohodealId);

        return $deal;
    }

    public function updateDeal(DealRequest $request, Deal $deal): Deal
    {
        $deal->update($request->validated());
        $dealResource = new DealResource($deal);
        $requestData = $dealResource->toArray($request);
        $this->zohoDealService->updateZohoDeal($requestData);

        return $deal;
    }

    public function deleteDeal(Deal $deal): void
    {
        $this->zohoDealService->deleteZohoAccount($deal->zoho_record_id);
        $deal->delete();
    }

    private function setZohoDealIdToAccount(Deal $deal, string $zohoDealId): void
    {
        $deal->update(['zoho_record_id' => $zohoDealId]);
    }
}
