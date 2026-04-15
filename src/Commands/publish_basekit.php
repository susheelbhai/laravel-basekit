<?php

namespace Susheelbhai\Basekit\Commands;

use Illuminate\Console\Command;
use Susheelbhai\Basekit\Commands\Helper\Publish;

class publish_basekit extends Command
{
    protected $signature = 'basekit:publish
                            {--stack= : Ignored. Blade/Inertia is chosen at runtime via .env (e.g. APP_RENDER_TYPE).}';

    protected $description = 'Publish starter kit resources (views, config, assets, etc).';

    public function handle(): int
    {
        (new Publish())->publishAll($this);

        return self::SUCCESS;
    }
}
