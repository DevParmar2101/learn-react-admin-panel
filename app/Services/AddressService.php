<?php

namespace App\Services;

use App\Models\Address;

class AddressService
{
    public function store($data, $addressable_type_data)
    {
        return Address::create([
            'addressable_type' => $addressable_type_data::class,
            'addressable_id' => $addressable_type_data['id'],
            'type' => $data['type'],
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
            'is_default' => $data['is_default'],
        ]);
    }
}
