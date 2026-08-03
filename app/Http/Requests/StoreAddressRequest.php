<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'address_line_1' => ['required', 'string'],
            'address_line_2' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'is_default' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'addressable_type.required' => 'Address Type is required',
            'addressable_id.required' => 'Address Id is required',
            'type.required' => 'Address Type is required',
            'address_line_1.required' => 'Address Line 1 is required',
            'address_line_2.required' => 'Address Line 2 is required',
            'city.required' => 'Address City is required',
            'state.required' => 'Address State is required',
            'country.required' => 'Address Country is required',
            'postal_code.required' => 'Address Postal Code is required',
            'is_default.required' => 'Address Default is required',
        ];
    }
}
