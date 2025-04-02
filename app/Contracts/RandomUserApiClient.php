<?php

namespace App\Contracts;

interface RandomUserApiClient
{
    public function fetchUsers(?int $count = null, ?string $nationality = null): array;
}