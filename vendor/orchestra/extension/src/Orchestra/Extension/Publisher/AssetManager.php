<?php namespace Orchestra\Extension\Publisher;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Foundation\AssetPublisher;
use Orchestra\Extension\FilePermissionException;

class AssetManager
{
    /**
     * Application instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $app = null;

    /**
     * Migrator instance.
     *
     * @var \Illuminate\Foundation\AssetPublisher
     */
    protected $publisher = null;

    /**
     * Construct a new instance.
     *
     * @param  \Illuminate\Container\Container          $app
     * @param  \Illuminate\Foundation\AssetPublisher    $publisher
     */
    public function __construct(Container $app, AssetPublisher $publisher)
    {
        $this->app       = $app;
        $this->publisher = $publisher;
    }

    /**
     * Run migration for an extension or application.
     *
     * @param  string   $name
     * @param  string   $destinationPath
     * @return mixed
     */
    public function publish($name, $destinationPath)
    {
        return $this->publisher->publish($name, $destinationPath);
    }

    /**
     * Migrate extension.
     *
     * @param  string   $name
     * @return mixed
     * @throws \Orchestra\Extension\FilePermissionException
     */
    public function extension($name)
    {
        $finder   = $this->app['orchestra.extension.finder'];
        $basePath = rtrim($this->app['orchestra.extension']->option($name, 'path'), '/');
        $path     = $finder->resolveExtensionPath("{$basePath}/public");

        if (! $this->app['files']->isDirectory($path)) {
            return false;
        }

        try {
            return $this->publish($name, $path);
        } catch (Exception $e) {
            throw new FilePermissionException("Unable to publish [{$path}].");
            return false;
        }
    }

    /**
     * Migrate Orchestra Platform.
     *
     * @return mixed
     * @throws \Orchestra\Extension\FilePermissionException
     */
    public function foundation()
    {
        $path = rtrim($this->app['path.base'], '/').'/vendor/orchestra/foundation/src/public';

        if (! $this->app['files']->isDirectory($path)) {
            return false;
        }

        try {
            return $this->publish('orchestra/foundation', $path);
        } catch (Exception $e) {
            throw new FilePermissionException("Unable to publish [{$path}].");
        }
    }
}
