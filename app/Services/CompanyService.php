<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Customer;

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

    /**
     * @param $data
     * @param Customer $customer
     * @return mixed
     */
    public function update($data,Customer $customer)
    {
//        dd($data);
        $company_data = Company::findOrFail($data['id']);

        $company_data->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'gst_number' => $data['gst_number'],
            'registration_number' => $data['registration_number'],
            'status' => $data['status'],
            'customer_id' => $customer->id,
        ]);
        return $company_data->refresh();
    }
}
