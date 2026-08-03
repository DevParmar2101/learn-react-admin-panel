<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'unique:customers,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'boolean'],

            'address' => ['required', 'array'],
            'address.type' => ['required', 'string'],
            'address.address_line_1' => ['required', 'string'],
            'address.address_line_2' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.postal_code' => ['required', 'string'],
            'address.is_default' => ['required', 'integer'],

            'company' => ['required', 'array'],
            'company.name' => ['required', 'string','max:255'],
            'company.phone' => ['nullable', 'string', 'max:20'],
            'company.email' => ['nullable', 'string', 'max:255'],
            'company.website' => ['nullable', 'string', 'max:255'],
            'company.gst_number' => ['nullable', 'string', 'max:255'],
            'company.registration_number' => ['nullable', 'string', 'max:255'],
            'company.status' => ['required', 'integer'],
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Customer name is required',
            'email.required' => 'Customer email is required',
            'email.email' => 'Customer email is not valid.',
            'phone.required' => 'Customer phone is required',
            'status.required' => 'Customer status is required',

            'address.addressable_type.required' => 'Address Type is required',
            'address.addressable_id.required' => 'Address Id is required',
            'address.type.required' => 'Address Type is required',
            'address.address_line_1.required' => 'Address Line 1 is required',
            'address.address_line_2.required' => 'Address Line 2 is required',
            'address.city.required' => 'Address City is required',
            'address.state.required' => 'Address State is required',
            'address.country.required' => 'Address Country is required',
            'address.postal_code.required' => 'Address Postal Code is required',
            'address.is_default.required' => 'Address Default is required',

            'company.name.required' => 'Company name is required',
            'company.phone.max' => 'company phone is too long.',
            'company.phone.required' => 'Company phone is required',
            'company.email.required' => 'Company email is required',
            'company.website.required' => 'Company website is required',
            'company.gst_number.required' => 'Company GST number is required',
            'company.registration_number.required' => 'Company Registration number is required',
            'company.status.required' => 'Company status is required',

        ];
    }
}
