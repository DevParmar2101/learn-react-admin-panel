<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
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
            ],
            'companies' => $this->companies->map(function($company) {
                return [
                    "id" => $company->id,
                    "name" => $company->name,
                    "email" => $company->email,
                    "phone" => $company->phone,
                    "website" => $company->website,
                    "gst_number" => $company->gst_number,
                    "registration_number" => $company->registration_number,
                    "status" => $company->status,
                ];
            })->values(),
        ];
    }
}
