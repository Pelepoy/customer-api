<?php

namespace App\Http\Controllers\Api;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerListResource;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    public function __construct(private CustomerRepository $customerRepository)
    {
    }

    public function index()
    {
        $customers = $this->customerRepository->getAll();
        return CustomerListResource::collection($customers);
    }

    public function show(int $id)
    {
        $customer = $this->customerRepository->getById($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return new CustomerResource($customer);
    }
}