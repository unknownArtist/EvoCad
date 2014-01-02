<?php namespace Orchestra\Extension;

use Illuminate\Foundation\AssetPublisher;
use Illuminate\Support\ServiceProvider;

class PublisherServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMigration();
        $this->registerAssetPublisher();
    }

    /**
     * Register the service provider for Orchestra Platform migrator.
     *
     * @return void
     */
    protected function registerMigration()
    {
        $this->app['orchestra.publisher.migrate'] = $this->app->share(function ($app) {
            // In order to use migration, we need to boot 'migration.repository'
            // instance.
            $app['migration.repository'];

            return new Publisher\MigrateManager($app, $app['migrator']);
        });
    }

    /**
     * Register the service provider for Orchestra Platform asset publisher.
     *
     * @return void
     */
    protected function registerAssetPublisher()
    {
        $this->app['orchestra.publisher.asset'] = $this->app->share(function ($app) {
            $publisher = new AssetPublisher($app['files'], $app['path.public']);

            return new Publisher\AssetManager($app, $publisher);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'orchestra.publisher.migrate',
            'orchestra.publisher.asset',
        );
    }
}
