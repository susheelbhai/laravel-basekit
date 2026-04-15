<?php

namespace Susheelbhai\Basekit\Commands\Helper;

use Illuminate\Support\Facades\Artisan;

class Publish
{
    /**
     * Publish every starter kit tag so Blade and Inertia can be switched at runtime (e.g. APP_RENDER_TYPE in .env).
     */
    public function publishAll($this_data): void
    {
        $this_data->info('Publishing Starter Kit...');

        $tags = [
            'basekit',
            'react_basekit_for_non_react_project',
            'basekit_themes',
        ];

        $allOk = true;

        foreach ($tags as $tag) {
            $exitCode = Artisan::call('vendor:publish', [
                '--tag'   => $tag,
                '--force' => true,
            ]);
            $this_data->line(Artisan::output());

            if ($exitCode !== 0) {
                $allOk = false;
            }
        }

        if ($allOk) {
            $this_data->info('✅ Starter Kit published successfully!');
        } else {
            $this_data->error('❌ Failed to publish Starter Kit');
        }
    }
}
