<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerService
{
    public function store(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'],
        ]);
    }
}
