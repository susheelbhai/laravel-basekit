<?php

namespace Susheelbhai\Basekit\Commands;

use Illuminate\Console\Command;
use Susheelbhai\Basekit\Commands\Helper\InstallPackages;

class install_package extends Command
{
    protected $signature = 'basekit:install_package
                            {--stack= : Ignored. All dependencies are installed; render mode is controlled at runtime via .env.}';

    protected $description = 'Install composer/npm dependencies required by the starter kit.';

    public function handle(): int
    {
        (new InstallPackages())->installAll($this);

        return self::SUCCESS;
    }
}
