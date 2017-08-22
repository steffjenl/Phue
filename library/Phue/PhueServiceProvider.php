<?php
namespace Phue;

use Illuminate\Routing\Router;
use Illuminate\Session\SessionManager;

class PhueServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/phue.php' => config_path('phue.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\BridgeFinder::class,
                Console\Commands\CreateUser::class,
                Console\Commands\LightFinder::class,
                Console\Commands\ListLights::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/phue.php',
            'phue'
        );
    }

}
