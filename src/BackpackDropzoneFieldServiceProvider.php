<?php

namespace JulienMru\BackpackDropzoneField;

use Illuminate\Support\ServiceProvider;

class BackpackDropzoneFieldServiceProvider extends ServiceProvider
{
    protected $commands = [
        \JulienMru\BackpackDropzoneField\app\Console\Commands\Install::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // publish field
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/backpack/crud')], 'views');

        // publish public assets
        $this->publishes([__DIR__ . '/public' => public_path('vendor/julienmru/laravel-backpack-dropzone-field')], 'public');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // register the artisan commands
        $this->commands($this->commands);
    }
}
