<?php

namespace App\Contracts;

use App\Entities\Customer;

interface CustomerRepository
{
    public function findByEmail(string $email): ?Customer;
    public function save(Customer $customer): void;
    public function getAll(): array;
    public function getById(int $id): ?Customer;
}