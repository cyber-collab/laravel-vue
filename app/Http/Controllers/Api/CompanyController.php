<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Http\Services\ImageUploadServices;
use App\Http\Services\CompanyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    public function __construct(protected ImageUploadServices $uploadService, protected CompanyService $companyService)
    {}

    public function index(): AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::all());
    }

    public function store(CompanyRequest $request): CompanyResource
    {
        $company = $this->companyService->createCompany($request);

        return new CompanyResource($company);
    }

    public function show(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company): CompanyResource
    {
        $data = $request->validated();
        $company = $this->companyService->updateCompany($company, $data);

        return new CompanyResource($company);
    }

    public function destroy(Company $company): Response
    {
        $company->delete();

        return response()->noContent();
    }
}
