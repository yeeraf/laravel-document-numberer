<?php

namespace Yeeraf\DocumentNumberer\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Yeeraf\DocumentNumberer\DocumentNumberer;
use Yeeraf\DocumentNumberer\PackageServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            PackageServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
