<?php

namespace App\Providers;

use App\Contracts\CustomerRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\RandomUserApiClient;
use App\Repositories\DoctrineCustomerRepository;
use App\Services\RandomUserApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RandomUserApiClient::class, function ($app) {
            return new RandomUserApiService(
                config('api.random_user.url'),
                config('api.random_user.nationality'),
                config('api.random_user.results')
            );
        });

        $this->app->bind(CustomerRepository::class, DoctrineCustomerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}