<?php

namespace App\Contracts;

interface RandomUserApiClient
{
    public function fetchUsers(int $count, string $nationality): array;
}