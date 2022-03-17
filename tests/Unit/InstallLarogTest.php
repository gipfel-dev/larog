<?php

namespace Larog\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Larog\Tests\TestCase;

class InstallLarogTest extends TestCase
{

    public function test_install_command_copies_the_configuration()
    {
        $config = config_path('larog.php');

        if (File::exists($config)) {
            File::delete($config);
        }

        $this->assertFalse(File::exists($config));

        Artisan::call('larog:install');

        $this->assertTrue(File::exists($config));
    }

}
