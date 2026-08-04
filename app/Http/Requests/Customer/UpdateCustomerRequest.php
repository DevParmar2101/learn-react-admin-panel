<?php

namespace App\Http\Requests\Customer;

use App\Enums\AddressType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * @return true
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('customers', 'email')->ignore($this->route('customer')->id),],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'boolean'],

            'address' => ['required', 'array'],
            'address.type' => ['required', Rule::in(AddressType::cases())],
            'address.address_line_1' => ['required', 'string'],
            'address.address_line_2' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.postal_code' => ['required','string'],
            'address.is_default' => ['required', 'boolean'],

            'companies' => ['required', 'array'],
            'companies.*.id' => ['required', 'integer'],
            'companies.*.name' => ['required', 'string' , 'max:255'],
            'companies.*.phone' => ['nullable', 'string', 'max:20'],
            'companies.*.email' => ['nullable', 'string', 'max:255'],
            'companies.*.website' => ['nullable', 'string', 'max:255'],
            'companies.*.gst_number' => ['nullable', 'string', 'max:255'],
            'companies.*.registration_number' => ['nullable', 'string', 'max:255'],
            'companies.*.status' => ['required', 'integer'],
            'companies.*.customer_id' => ['nullable', 'integer'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Customer name is required.',
            'email.required' => 'Customer email is required.',
            'email.email' => 'Customer email is not valid.',
            'phone.required' => 'Customer phone is required.',
            'status.required' => 'Customer status is required.',

            'address.addressable_type.required' => 'Address Type is required.',
            'address.addressable_id.required' => 'Address Id is required.',
            'address.type.required' => 'Address Type is required.',
            'address.address_line_1.required' => 'Address Line 1 is required.',
            'address.address_line_2.required' => 'Address Line 2 is required.',
            'address.city.required' => 'Address City is required.',
            'address.state.required' => 'Address State is required.',
            'address.country.required' => 'Address Country is required.',
            'address.postal_code.required' => 'Address Postal Code is required.',
            'address.is_default.required' => "Is default address is required.",

            'companies.*.id.required' => 'Company name is required.',
            'companies.*.name.required' => 'Company name is required.',
            'companies.*.phone.required' => 'Company phone is required.',
            'companies.*.email.required' => 'Company email is required.',
            'companies.*.website.required' => 'Company website is required.',
            'companies.*.gst_number.required' => 'Company GST number is required.',
            'companies.*.registration_number.required' => 'Company registration number is required.',
            'companies.*.status.required' => 'Company status is required.',
            'companies.*.customer_id.required' => 'Customer id is required.',
        ];
    }
}
