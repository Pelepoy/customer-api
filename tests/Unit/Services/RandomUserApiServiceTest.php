<?php

namespace Tests\Unit\Services;

use App\Services\RandomUserApiService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RandomUserApiServiceTest extends TestCase
{
    private $apiService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiService = new RandomUserApiService(
            config('api.random_user.url'),
            config('api.random_user.nationality'),
            config('api.random_user.results')
        );
    }

    public function test_it_fetches_users_successfully()
    {
        Http::preventStrayRequests(); // Block real API calls

        Http::fake([ // fake the API response
            config('api.random_user.url'). "*" => Http::response([
                'results' => [
                    ['email' => 'test@example.com']
                ]
            ]),
        ]);

        $users = $this->apiService->fetchUsers(100, 'AU');

        // dump($users);

        $this->assertCount(1, $users);
        $this->assertEquals('test@example.com', $users[0]['email']);
    }

    public function test_it_throws_exception_on_api_failure()
    {
        Http::preventStrayRequests(); // Block real API calls
        
        Http::fake([
            config('api.random_user.url'). "*" => Http::response([], 500),
        ]);

        $this->expectException(\App\Exceptions\ApiClientException::class);

        $this->apiService->fetchUsers();
    }
}