<?php

namespace DW\InstaCrawl;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/instacrawl.php',
            'instacrawl'
        );

        $this->app->bind('instacrawl', function () {
            return new InstaCrawl;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/instacrawl.php' => config_path('instacrawl'),
        ]);
    }
}
