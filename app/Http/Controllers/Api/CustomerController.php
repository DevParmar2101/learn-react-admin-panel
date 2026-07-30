<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Resources\UserResource;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public CustomerService $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->store($request->validated());

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => new UserResource($customer)

        ]);
    }
}
