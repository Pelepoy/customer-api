<?php

namespace App\Services;

use App\Contracts\RandomUserApiClient;
use Illuminate\Support\Facades\Http;
use App\Exceptions\ApiClientException;

class RandomUserApiService implements RandomUserApiClient
{
    public function __construct(
        private string $baseUrl,
        private string $defaultNationality,
        private int $defaultResults
    ) {}

    public function fetchUsers(int $count = null, string $nationality = null): array
    {
        $response = Http::get($this->baseUrl, [
            'results' => $count ?? $this->defaultResults,
            'nat' => $nationality ?? $this->defaultNationality,
        ]);

        if ($response->failed()) {
            throw new ApiClientException('Failed to fetch users from API');
        }

        return $response->json()['results'] ?? [];
    }
}