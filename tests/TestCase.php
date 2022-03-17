<?php

namespace Larog\Tests;

use Larog\Larog\LarogServiceProvider;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function getPackageProviders(): array
    {
        return [
            LarogServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp(): void
    {
        //
    }

    public function setUp(): void
    {
        parent::setUp();
    }
}
