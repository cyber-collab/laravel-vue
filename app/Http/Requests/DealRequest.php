<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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

    public function rules()
    {
        return [
            'deal_name' => ['required', 'string'],
            'closing_date' => ['required', 'date'],
            'account_id' => ['required', 'int'],
            'stage' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'deal_name.required' => 'The "Deal Name" field is required.',
            'closing_date.required' => 'The "Closing Date" field is required.',
            'account_id.required' => 'The "Account ID" field is required.',
            'stage.required' => 'The "Stage" field is required.',
        ];
    }
}
