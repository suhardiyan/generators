<?php

namespace Suhardiyan\Generators;

/*
 *
 * @author Michael McMullen <michael@suhardiyan.co>
 */

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/modelfromtable.php' => config_path('modelfromtable.php'),
        ], 'modelfromtable');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/modelfromtable.php', 'modelfromtable');
        $this->registerModelGenerator();
    }

    private function registerModelGenerator()
    {
        $this->app->singleton('command.suhardiyan.generate', function ($app) {
            return $app['Suhardiyan\Generators\Commands\ModelFromTableCommand'];
        });

        $this->commands('command.suhardiyan.generate');
    }
}
