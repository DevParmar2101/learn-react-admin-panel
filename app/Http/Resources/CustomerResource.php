<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'address' =>[
                'type' => $this->officeAddress->type,
                'address_line_1' => $this->officeAddress->address_line_1,
                'address_line_2' => $this->officeAddress->address_line_2,
                'city' => $this->officeAddress->city,
                'state' => $this->officeAddress->state,
                'country' => $this->officeAddress->country,
                'postal_code' => $this->officeAddress->postal_code,
                'is_default' => $this->officeAddress->is_default,

            ]
        ];
    }
}
