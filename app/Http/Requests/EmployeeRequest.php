<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'company_id' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The "First Name" field is required.',
            'last_name.required' => 'The "Last Name" field is required.',
            'company_id.required' => 'The "Company ID" field is required.',
            'email.required' => 'The "Email" field is required.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }
}
