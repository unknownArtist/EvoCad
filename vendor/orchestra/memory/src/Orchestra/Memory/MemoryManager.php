<?php namespace Orchestra\Memory;

use Exception;
use Orchestra\Support\Manager;

class MemoryManager extends Manager
{
    /**
     * Create Fluent driver.
     *
     * @param  string   $name
     * @return \Orchestra\Memory\Drivers\Fluent
     */
    protected function createFluentDriver($name)
    {
        return new Drivers\Fluent($this->app, $name);
    }

    /**
     * Create Eloquent driver.
     *
     * @param  string   $name
     * @return \Orchestra\Memory\Drivers\Eloquent
     */
    protected function createEloquentDriver($name)
    {
        return new Drivers\Eloquent($this->app, $name);
    }

    /**
     * Create Cache driver.
     *
     * @param  string   $name
     * @return \Orchestra\Memory\Drivers\Cache
     */
    protected function createCacheDriver($name)
    {
        return new Drivers\Cache($this->app, $name);
    }

    /**
     * Create Runtime driver.
     *
     * @param  string   $name
     * @return \Orchestra\Memory\Drivers\Runtime
     */
    protected function createRuntimeDriver($name)
    {
        return new Drivers\Runtime($this->app, $name);
    }

    /**
     * Create Default driver.
     *
     * @return string
     */
    protected function getDefaultDriver()
    {
        return $this->app['config']->get('orchestra/memory::config.driver', 'fluent.default');
    }

    /**
     * Make default driver or fallback to runtime.
     *
     * @param  string   $fallbackName
     * @return \Orchestra\Memory\Drivers\Driver
     */
    public function makeOrFallback($fallbackName = 'orchestra')
    {
        try {
            return $this->make();
        } catch (Exception $e) {
            return $this->driver("runtime.{$fallbackName}");
        }
    }

    /**
     * Loop every instance and execute finish method (if available).
     *
     * @return void
     */
    public function finish()
    {
        foreach ($this->drivers as $class) {
            $class->finish();
        }

        $this->drivers = array();
    }
}
