<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     *
     * @return true
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation Rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('user')->id),],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'boolean'],
        ];
    }

    /**
     * Custom Messages
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email already exists.',
            'status.required' => 'Status is required.',
        ];
    }
}
