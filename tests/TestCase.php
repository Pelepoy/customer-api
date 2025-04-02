<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function test_test_environment()
    {
        var_dump ([
            "Active Environment" => app()->environment(),
            "DB_CONNECTION" => config('database.default'),
            "DB_DATABASE" => config('database.connections.sqlite.database')
        ]);
    }
}