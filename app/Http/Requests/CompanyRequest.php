<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'website' => ['nullable', 'url'],
            'logo' => ['nullable', 'file', 'mimes:jpeg,png', 'max:5000'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The "Name" field is required.',
            'email.required' => 'The "Email" field is required.',
            'email.email' => 'Please enter a valid email address.',
            'website.url' => 'Please enter a valid URL for the "Website" field.',
            'logo.file' => 'Please enter accepted image',
        ];
    }
}
