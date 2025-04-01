<?php

namespace App\Services;

use App\Contracts\RandomUserApiClient;
use App\Entities\Customer;
use App\Exceptions\ImportException;
use App\Repositories\DoctrineCustomerRepository;

class CustomerImportService
{
    public function __construct(
        private RandomUserApiClient $apiClient,
        private DoctrineCustomerRepository $customerRepository
    ) {}

    public function import(int $count = null, string $nationality = null): int
    {
        try {
            $users = $this->apiClient->fetchUsers($count, $nationality);
            $imported = 0;

            foreach ($users as $user) {
                $customer = $this->customerRepository->findByEmail($user['email']) ?? new Customer();
                
                $customer->setEmail($user['email']);
                $customer->setFirstName($user['name']['first']);
                $customer->setLastName($user['name']['last']);
                $customer->setUsername($user['login']['username']);
                $customer->setPassword(md5($user['login']['password']));
                $customer->setGender($user['gender']);
                $customer->setCountry($user['location']['country']);
                $customer->setCity($user['location']['city']);
                $customer->setPhone($user['phone']);

                $this->customerRepository->save($customer);
                $imported++;
            }

            return $imported;
        } catch (\Exception $e) {
            throw new ImportException('Import failed: ' . $e->getMessage());
        }
    }
}