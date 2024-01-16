<?php

namespace App\Http\Services;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Services\ImageUploadServices;

class CompanyService
{
    protected $uploadService;

    public function __construct(ImageUploadServices $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function createCompany(CompanyRequest $request): Company
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadService->uploadImage($request->file('logo'));
        }

        return Company::create($data);
    }

    public function updateCompany(Company $company, array $data): Company
    {
        if (array_key_exists('logo', $data) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
            $data['logo'] = $this->uploadService->uploadImage($data['logo']);
        }

        $company->update($data);

        return $company;
    }
}
