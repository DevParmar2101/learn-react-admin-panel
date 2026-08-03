<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'gst_number' => $data['gst_number'],
            'registration_number' => $data['registration_number'],
            'status' => $data['status'],
        ]);
    }
}
