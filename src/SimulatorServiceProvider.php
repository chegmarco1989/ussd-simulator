<?php

namespace TNM\UssdSimulator;

use Illuminate\Support\ServiceProvider;
use TNM\UssdSimulator\Commands\Simulate;

class SimulatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Simulate::class
            ]);
        }
    }
}
