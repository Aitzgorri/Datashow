<?php

namespace Aitzgorri\Datashow;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Aitzgorri\Datashow\Facades\Datashow;

class DatashowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/datashow.php', 'datashow'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->runningInConsole()){
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    private function registerResources() {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/datashow', 'Datashow');
        $this->registerFacades(); // facades MUST be registered first as the facade is used in following registration functions
        $this->registerRoutes();
    }

    protected function registerRoutes() {
        Route::group($this->routeConfiguration(), function(){
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    private function routeConfiguration() {
        return [
            'prefix' => Datashow::prefixPath(),
            'namespace' => 'Aitzgorri\Datashow\Http\Controllers'
        ];
    }

    protected function registerFacades() {
        $this->app->singleton('Datashow', function() {
            return new \Aitzgorri\Datashow\Datashow;
        });
    }

    protected function registerPublishing() {
        $this->publishes([
            __DIR__ . '/../config/datashow.php' => config_path('datashow.php'),
        ], 'datashow-config');
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/datashow'),
        ], 'datashow-views');
    }
}
