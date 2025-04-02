<?php

namespace Tests\Feature;

use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DatabaseTestCase;
use Tests\TestCase;

class CustomerApiTest extends DatabaseTestCase
{
    // use RefreshDatabase;

    private $em;

    protected function setUp(): void
    {
        parent::setUp();
        $this->em = app(EntityManagerInterface::class);
    }

    public function test_it_lists_all_customers()
    {
        $customer = new Customer();
        $customer->setEmail('test@example.com');
        $customer->setFirstName('John');
        $customer->setLastName('Doe');
        $customer->setUsername('johndoe');
        $customer->setPassword(md5('secret'));
        $customer->setGender('male');
        $customer->setCountry('Australia');
        $customer->setCity('Sydney');
        $customer->setPhone('1234567890');

        $this->em->persist($customer);
        $this->em->flush();

        $response = $this->getJson('/api/customers');

        // dump($response->json());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [  // '*' means "for each item in the data array"
                        'full_name',
                        'email',
                        'country'
                    ]
                ]
            ]);
    }

    public function test_it_shows_single_customer()
    {
        $customer = new Customer();
        $customer->setEmail('single@example.com');
        $customer->setFirstName('John');
        $customer->setLastName('Doe');
        $customer->setUsername('johndoe');
        $customer->setPassword(md5('secret'));
        $customer->setGender('male');
        $customer->setCountry('Australia');
        $customer->setCity('Sydney');
        $customer->setPhone('1234567890');

        $this->em->persist($customer);
        $this->em->flush();
        $customerId = $customer->getId();

        $response = $this->getJson("/api/customers/{$customerId}");

        // dump($response->json());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'full_name',
                    'email',
                    'username',
                    'gender',
                    'country',
                    'city',
                    'phone'
                ]
            ]);
    }

    public function test_it_returns_404_for_nonexistent_customer()
    {
        $response = $this->getJson('/api/customers/9999');

        $response->assertStatus(404)
            ->assertJson(['message' => 'Customer not found']);
    }
}