<?php

namespace Susheelbhai\Basekit;

use Illuminate\Support\ServiceProvider;

class BasekitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'basekit');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPublishable();

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Susheelbhai\Basekit\Commands\initial_settings::class,
                \Susheelbhai\Basekit\Commands\install_package::class,
                \Susheelbhai\Basekit\Commands\publish_basekit::class,
                \Susheelbhai\Basekit\Commands\final_settings::class,
            ]);
        }
    }

    public function registerPublishable()
    {
        $publishables = [
            __dir__ . "/Livewire" => \app_path('/Livewire'),
            __dir__ . "/Console" => \app_path('/Console'),
            __dir__ . "/Http" => \app_path('/Http'),
            __dir__ . "/Providers" => \app_path('/Providers'),
            __dir__ . "/Models" => \app_path('/Models'),
            __dir__ . "/Support" => \app_path('/Support'),
            __dir__ . "/Traits" => \app_path('/Traits'),
            __dir__ . "/Notifications" => \app_path('/Notifications'),
            __dir__ . "/Helpers" => \app_path('/Helpers'),
            __dir__ . "/Events" => \app_path('/Events'),
            __dir__ . "/Listeners" => \app_path('/Listeners'),
            __dir__ . "/View" => \app_path('/View'),
            __dir__ . "/../database" => \database_path('/'),
            __dir__ . "/../config" => \config_path('/'),
            __dir__ . "/../routes" => \base_path('/routes'),
            __DIR__ . '/../resources/views' => \base_path('resources/views'),
            __DIR__ . '/../resources/css' => \base_path('resources/css'),
            __DIR__ . '/../resources/js' => \base_path('resources/js'),
            __DIR__ . '/../resources/react_views' => \base_path('resources/views'),
            __DIR__ . '/../resources/mail_views' => \base_path('resources/views'),
            __DIR__ . '/../resources/data' => \base_path('resources/data'),
            __DIR__ . '/../bootstrap' => \base_path('bootstrap'),

            __dir__ . "/../assets/storage_public/media" => \storage_path('app/public'),
            __dir__ . "/../assets/storage_public/.gitignore" => \storage_path('app/public/.gitignore'),
            __dir__ . "/../assets/storage_public/.sync-exclude.lst" => \storage_path('/.sync-exclude.lst'),
            __dir__ . "/../assets/storage" => \storage_path('/'),

            __dir__ . "/../assets/public/css" => \public_path('css'),
            __dir__ . "/../assets/public/themes/ck_editor" => \public_path('themes/ck_editor'),
            __dir__ . "/../assets/public/themes/tinymce" => \public_path('themes/tinymce'),
            __dir__ . "/../tests" => \base_path('tests'),
        ];

        // New unified publish tag (switchable via APP_RENDER_TYPE).
        $this->publishes($publishables, 'basekit');

        // Backward-compatible aliases.
        $this->publishes($publishables, 'blade_basekit');
        $this->publishes($publishables, 'react_basekit');

        $this->publishes([
            __dir__ . "/../assets/root" => \base_path('/')
        ], 'react_basekit_for_non_react_project');

        $this->publishes([
            __dir__ . "/../assets/public" => \public_path('')
        ], 'basekit_themes');
    }
}
