<?php

namespace Tests\Unit\Services;

use App\Contracts\RandomUserApiClient;
use App\Entities\Customer;
use App\Repositories\DoctrineCustomerRepository;
use App\Services\CustomerImportService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CustomerImportServiceTest extends TestCase
{
    use RefreshDatabase;

    private MockInterface|RandomUserApiClient $apiClient;
    private MockInterface|DoctrineCustomerRepository $repository;
    private CustomerImportService $importService;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock dependencies
        $this->apiClient = Mockery::mock(RandomUserApiClient::class);
        $this->repository = Mockery::mock(DoctrineCustomerRepository::class);
        $this->importService = new CustomerImportService($this->apiClient, $this->repository);
    }

    public function test_it_imports_new_customers()
    {
        $mockUsers = [
            [
                'email' => 'test@example.com',
                'name' => ['first' => 'John', 'last' => 'Doe'],
                'login' => ['username' => 'johndoe', 'password' => 'secret'],
                'gender' => 'male',
                'location' => ['country' => 'Australia', 'city' => 'Sydney'],
                'phone' => '1234567890',
            ]
        ];

        $this->apiClient->shouldReceive('fetchUsers')
            ->once()
            ->with(100, 'AU')
            ->andReturn($mockUsers);

        $this->repository->shouldReceive('findByEmail')
            ->once()
            ->with('test@example.com')
            ->andReturnNull();

        $this->repository->shouldReceive('save')
            ->once();

        $importedCount = $this->importService->import(100, 'AU');

        $this->assertEquals(1, $importedCount);
    }

    public function test_it_updates_existing_customers()
    {
        $existingCustomer = new Customer();
        $mockUsers = [
            [
                'email' => 'existing@example.com',
                'name' => ['first' => 'Jane', 'last' => 'Doe'],
                'login' => ['username' => 'janedoe', 'password' => 'secret'],
                'gender' => 'female',
                'location' => ['country' => 'Australia', 'city' => 'Melbourne'],
                'phone' => '0987654321',
            ]
        ];

        $this->apiClient->shouldReceive('fetchUsers')
            ->once()
            ->andReturn($mockUsers);

        $this->repository->shouldReceive('findByEmail')
            ->once()
            ->with('existing@example.com')
            ->andReturn($existingCustomer);

        $this->repository->shouldReceive('save')
            ->once();

        $importedCount = $this->importService->import();

        $this->assertEquals(1, $importedCount);
    }

    public function test_it_throws_exception_on_api_failure()
    {
        $this->apiClient->shouldReceive('fetchUsers')
            ->once()
            ->andThrow(new \Exception('API failed'));

        $this->expectException(\App\Exceptions\ImportException::class);

        $this->importService->import();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}