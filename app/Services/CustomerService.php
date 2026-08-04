<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerService
{
    protected AddressService $addressService;
    protected CompanyService $companyService;

    public function __construct(AddressService $addressService, CompanyService $companyService)
    {
        $this->addressService = $addressService;
        $this->companyService = $companyService;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('name')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like','%'.$search.'%')
                ->orWhere('email', 'like','%'.$search.'%');
            });
        }

        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order','desc');

        $query->orderBy($sortBy, $sortOrder);
        return $query->paginate(
            $request->get('per_page',15)
        );
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'],
        ]);
    }

    /**
     * @param Customer $customer
     * @return void
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    }

    /**
     * @param int $id
     * @return Collection|Model|SoftDeletes|null
     */
    public function restore(int $id)
    {
        $customer = Customer::withTrashed()->find($id);
        $customer->restore();

        return $customer->refresh();
    }

    /**
     * @param Customer $customer
     * @param array $data
     * @return Customer
     */
    public function update(Customer $customer, array $data)
    {
        $customer->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'],
        ]);
        $this->addressService->update($customer->officeAddress, $data['address']);
        if (count($data['companies']) >= 1){
            foreach ($data['companies'] as $i => $company) {
                $this->companyService->update($company, $customer);
            }
        }
        return $customer->refresh();
    }
}
