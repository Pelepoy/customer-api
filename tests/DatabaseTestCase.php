<?php

namespace Tests;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class DatabaseTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->artisan('doctrine:schema:create');
    }

    protected function tearDown(): void
    {
        $this->artisan('doctrine:schema:drop');
        
        parent::tearDown();
    }
}