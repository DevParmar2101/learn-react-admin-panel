<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use App\Services\AddressService;
use App\Services\CompanyService;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public CustomerService $customerService;
    public AddressService $addressService;
    public CompanyService $companyService;
    public function __construct(CustomerService $customerService, AddressService $addressService, CompanyService $companyService)
    {
        $this->customerService = $customerService;
        $this->addressService = $addressService;
        $this->companyService = $companyService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $customers = $this->customerService->index($request);

        return response()->json([
            'success' => true,
            'message' => "Customers fetched successfully",
            'data' => CustomerResource::collection($customers),
            'meta' => [
                'total' => $customers->total(),
                'per_page' => $customers->perPage(),
                'current_page' => $customers->currentPage(),
                'last_page' => $customers->lastPage(),
            ]
        ], 201);
    }

    /**
     * @param StoreCustomerRequest $request
     * @return JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->store($request->validated());
        $address = $this->addressService->store($request->validated()['address'], $customer);
        if (count($request['companies']) >=1) {
            foreach ($request['companies'] as $i => $company) {
                $this->companyService->store($company, $customer);
            }
        }
        return response()->json([
            'message' => 'Customer created successfully',
            'data' => new CustomerResource($customer)
        ], 201);
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(Customer $customer)
    {
        return response()->json([
            'success' => true,
            'message' => "Customer fetched successfully",
            'data' => new CustomerResource($customer),
        ], 201);
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer)
    {
        $this->customerService->destroy($customer);

        return response()->json([
            'success' => true,
            'message' => "Customer deleted successfully",
        ], 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id)
    {
        $customer = $this->customerService->restore($id);

        return response()->json([
            'success' => true,
            'message' => "Customer restored successfully",
            'data' => new CustomerResource($customer),
        ]);
    }

    /**
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $updateCustomer = $this->customerService->update($customer, $request->validated());

        return response()->json([
            'success' => true,
            'message' => "Customer details updated successfully",
            'data' => new CustomerResource($updateCustomer),
        ]);
    }
}
