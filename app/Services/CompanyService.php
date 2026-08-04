<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    /**
     * @param $data
     * @param $customer
     * @return mixed
     */
    public function store($data, $customer)
    {
        return Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'gst_number' => $data['gst_number'],
            'registration_number' => $data['registration_number'],
            'status' => $data['status'],
            'customer_id' => $customer['id'],
        ]);
    }
}
