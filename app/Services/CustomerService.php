<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerService
{
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
}
