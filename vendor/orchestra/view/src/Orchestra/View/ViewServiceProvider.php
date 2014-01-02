<?php namespace Orchestra\View;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViewFinder();
        $this->registerTheme();
    }

    /**
     * Register the service provider for view finder.
     *
     * @return void
     */
    protected function registerViewFinder()
    {
        $this->app['view.finder'] = $this->app->share(function ($app) {
            $paths = $app['config']['view.paths'];

            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Register the service provider for theme.
     *
     * @return void
     */
    protected function registerTheme()
    {
        $this->app['orchestra.theme'] = $this->app->share(function ($app) {
            return new Theme\ThemeManager($app);
        });

        $this->app['orchestra.theme.finder'] = $this->app->share(function ($app) {
            return new Theme\Finder($app);
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        $memory = $app['orchestra.memory']->makeOrFallback();

        // By default, we should consider all request to use "frontend"
        // theme and only convert to use "backend" routing when certain
        // event is fired.
        $app['orchestra.theme']->setTheme($memory->get('site.theme.frontend'));

        $app['events']->listen('orchestra.started: admin', function () use ($app, $memory) {
            $app['orchestra.theme']->setTheme($memory->get('site.theme.backend'));
        });

        // The theme is only booted when the first view is being composed.
        // This would prevent multiple theme being booted in the same
        // request.
        $app['events']->listen('composing: *', function () use ($app) {
            $app['orchestra.theme']->boot();
        });
    }
}
