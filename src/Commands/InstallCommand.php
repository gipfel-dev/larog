<?php

namespace Larog\Larog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends Command
{

    protected $signature = 'larog:install';

    protected $description = 'Install Larog into your existing Laravel application.';

    public function handle(): void
    {
        $this->info('Installing Larog...');

        if (!$this->configurationExists()) {
            $this->publishConfiguration();
        } elseif ($this->shouldOverwriteConfiguration()) {
            $this->publishConfiguration(true);
            $this->info('Overwriting configuration...');
        }
    }

    protected function configurationExists(): bool
    {
        $filename = 'larog.php';

        return File::exists(config_path($filename));
    }

    protected function publishConfiguration(bool $forcePublish = false): void
    {
        $params = [
            '--provider' => 'Larog\Larog\LarogServiceProvider',
            '--tag' => 'config'
        ];

        if ($forcePublish) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    protected function shouldOverwriteConfiguration(): bool
    {
        return $this->confirm('Configuration already exists. Do you want to overwrite it?', false);
    }

}
