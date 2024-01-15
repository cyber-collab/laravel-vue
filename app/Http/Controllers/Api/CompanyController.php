<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use App\Http\Services\ImageUploadServices;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    // public function __construct(
    //     private ImageUploadServices $imageUploadService
    // ) {}

    public function index(): AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::all());
    }

    public function store(CompanyRequest $request): CompanyResource
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $this->storeLogo($file);
            $data['logo'] = $fileName;
        }
        // $this->imageUploadService->uploadImage($request, $data);

        $company = Company::create($data);

        return new CompanyResource($company);
    }

    private function storeLogo(UploadedFile $file): string
    {
        $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $fileName, 'public');
        return $fileName;
    }

    public function show(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company): CompanyResource
    {
        $data = $request->validated();

        // $this->imageUploadService->uploadImage($request, $data);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $this->storeLogo($file);
            $data['logo'] = $fileName;
        }

        $company->update($data);

        return new CompanyResource($company);
    }

    public function destroy(Company $company): Response
    {
        $company->delete();

        return response()->noContent();
    }
}
