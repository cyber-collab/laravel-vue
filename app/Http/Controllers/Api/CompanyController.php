<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\UploadedFile;

class CompanyController extends Controller
{
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $this->storeLogo($file);
            $data['logo'] = $fileName;
        }

        $company = Company::create($data);

        return new CompanyResource($company);
    }

    private function storeLogo(UploadedFile $file)
    {
        $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $fileName, 'public');
        return $fileName;
    }

    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $this->storeLogo($file);
            $data['logo'] = $fileName;
        }

        $company->update($data);

        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return response()->noContent();
    }
}
