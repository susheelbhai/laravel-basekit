<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Helper', \App\Helpers\Helper::class);

        if (config('app.env') === 'production') {
            $this->app->usePublicPath(base_path('public_html'));
        }
    }

    public function boot(): void
    {
        // Blade-only Livewire route overrides for custom public path setups.
        // Kept runtime-switchable via APP_RENDER_TYPE/config('app.render_type').
        $renderType = (string) config('app.render_type', 'blade');

        if ($renderType !== 'blade') {
            return;
        }

        if (! class_exists(\Livewire\Livewire::class)) {
            return;
        }

        // If you need these in local only, uncomment the env guard.
        // if (config('app.env') === 'local') {
        //     \Livewire\Livewire::setScriptRoute(function ($handle) {
        //         return Route::get('/{custom_path_after_root_url}/livewire/livewire.js', $handle);
        //     });
        //     \Livewire\Livewire::setUpdateRoute(function ($handle) {
        //         return Route::post('/{custom_path_after_root_url}/livewire/update', $handle);
        //     });
        // }
    }
}

