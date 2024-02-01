<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'website' => ['nullable', 'url'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The "First Name" field is required.',
            'website.url' => 'Please enter a valid URL for the "Website" field.',
            'phone.required' => 'The "Phone" field is required.',
        ];
    }
}
