<?php namespace Tappleby\AuthToken;

use Illuminate\Support\ServiceProvider;

class AuthTokenServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        // Publish a config file
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('authtoken.php')
        ], 'config');

        // Publish your migrations
        $this->publishes([
            __DIR__ . '/../../migrations/' => database_path('/migrations')
        ], 'migrations');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton('tappleby.auth.token', function ($app) {
            return new AuthTokenManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('tappleby.auth.token');
    }

}
