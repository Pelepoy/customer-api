<?php

namespace App\Repositories;

use App\Contracts\CustomerRepository;
use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCustomerRepository implements CustomerRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findByEmail(string $email): ?Customer
    {
        return $this->entityManager
            ->getRepository(Customer::class)
            ->findOneBy(['email' => $email]);
    }

    public function save(Customer $customer): void
    {
        $this->entityManager->persist($customer);
        $this->entityManager->flush();
    }

    public function getAll(): array
    {
        return $this->entityManager
            ->getRepository(Customer::class)
            ->findAll();
    }

    public function getById(int $id): ?Customer
    {
        return $this->entityManager->find(Customer::class, $id);
    }
}