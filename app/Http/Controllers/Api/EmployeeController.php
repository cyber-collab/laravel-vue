<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return EmployeeResource::collection(Employee::all());
    }

    public function store(EmployeeRequest $request): EmployeeResource
    {
        $employee = Employee::create($request->validated());

        return new EmployeeResource($employee);
    }

    public function show(Employee $employee): EmployeeResource
    {
        return new EmployeeResource($employee);
    }

    public function update(EmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    public function destroy(Employee $employee): Response
    {
        $employee->delete();

        return response()->noContent();
    }
}
