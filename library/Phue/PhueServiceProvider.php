<?php
namespace Phue;

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

        $this->app->singleton(Client::class, function ($app) {
            return new Client(config('phue.ip'), config('phue.username'));
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }

}
