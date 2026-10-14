<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // phpunit.xml points tests at an in-memory SQLite connection, which starts
    // with no schema. Migrate it fresh for every test so `php artisan test`
    // works on a clean clone with no database/database.sqlite file.
    use RefreshDatabase;
}
