<?php namespace Orchestra\Facile;

use InvalidArgumentException;
use Illuminate\Support\Contracts\RenderableInterface;

class Response implements RenderableInterface
{
    /**
     * Environment instance.
     *
     * @var Environment
     */
    protected $env = null;

    /**
     * Template instance.
     *
     * @var Template\Driver
     */
    protected $template = null;

    /**
     * View format.
     *
     * @var string
     */
    protected $format = null;

    /**
     * View data.
     *
     * @var array
     */
    protected $data = array(
        'view'   => null,
        'data'   => array(),
        'status' => 200,
    );

    /**
     * Construct a new Response instance.
     *
     * @param  Environment      $env
     * @param  Template\Driver  $template
     * @param  array            $data
     * @param  string           $format
     */
    public function __construct(Environment $env, Template\Driver $template, array $data = array(), $format = null)
    {
        $this->env  = $env;
        $this->data = array_merge($this->data, $data);

        $this->template($template);
        $this->setFormat($format);
    }

    /**
     * Nest a view to Facile.
     *
     * @param  string   $view
     * @return Response
     */
    public function view($view)
    {
        $this->data['view'] = $view;

        return $this;
    }

    /**
     * Nest a data or dataset to Facile.
     *
     * @param  mixed    $key
     * @param  mixed    $value
     * @return Response
     */
    public function with($key, $value = null)
    {
        $data = is_array($key) ? $key : array($key => $value);

        $this->data['data'] = array_merge($this->data['data'], $data);

        return $this;
    }

    /**
     * Set HTTP status to Facile.
     *
     * @param  integer  $status
     * @return Response
     */
    public function status($status = 200)
    {
        $this->data['status'] = $status;

        return $this;
    }

    /**
     * Set a template for Facile.
     *
     * @param  mixed    $name
     * @return Response
     */
    public function template($name)
    {
        if ($name instanceof Template\Driver) {
            $this->template = $name;
        } else {
            $this->template = $this->env->get($name);
        }

        return $this;
    }

    /**
     * Get expected facile format.
     *
     * @param  string   $format
     * @return Response
     */
    public function format($format = null)
    {
        if (! is_null($format) and ! empty($format)) {
            $this->setFormat($format);
        } else {
            $this->getFormat();
        }

        return $this;
    }

    /**
     * Set Output Format.
     *
     * @param  string   $format
     * @return Response
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get Output Format.
     *
     * @return string
     */
    public function getFormat()
    {
        if (is_null($this->format)) {
            $this->format = $this->template->format();
        }

        return $this->format;
    }

    /**
     * Magic method to __get.
     *
     * @param  string   $key
     * @return mixed
     */
    public function __get($key)
    {
        if (! in_array($key, array('template', 'format'))) {
            throw new InvalidArgumentException("Invalid request to [{$key}].");
        }

        return $this->{$key};
    }

    /**
     * Render facile by selected format.
     *
     * @return string
     */
    public function __toString()
    {
        $content = $this->render();

        if ($content instanceof RenderableInterface) {
            return $content->render();
        }

        return $content;
    }

    /**
     * Render facile by selected format.
     *
     * @return mixed
     */
    public function render()
    {
        if (is_null($this->format)) {
            $this->format();
        }

        return $this->template->compose($this->getFormat(), $this->data);
    }
}
