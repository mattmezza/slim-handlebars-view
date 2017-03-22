<?php
/**
 * Slim Handlebars - a Handlebars view class for Slim
 *
 * @author  Matteo Merola
 * @link    https://github.com/mattmezza
 *
 */
namespace Slim\Views;

use Psr\Http\Message\ResponseInterface;

/**
 * Handlebars view
 *
 * The Handlebars view is a custom View class that renders templates using the Handlebars
 * template language (https://github.com/XaminProject/handlebars.php).
 *
 */
class Handlebars implements \ArrayAccess
{

    protected $loader;
    protected $environment;
    protected $defaultVariables = [];

    /**
     * Create new Handlebars view
     *
     * @param string $path     Path to templates directory
     * @param string $pathPartials     Path to partials templates directory
     * @param array        $settings Handlebars environment settings
     */
    public function __construct($path, $pathPartials = 'partials', $settings = ['extension'=>'html'])
    {
        $this->loader = new \Handlebars\Loader\FilesystemLoader($path, $settings);
        $this->partialsLoader = new \Handlebars\Loader\FilesystemLoader($path . '/' . $pathPartials, $settings);
        $this->environment = new \Handlebars\Handlebars(
              ["loader" => $this->loader,
               "partials_loader" => $this->partialsLoader]);
    }

    /**
     * Fetch rendered template
     *
     * @param  string $template Template pathname relative to templates directory
     * @param  array  $data     Associative array of template variables
     *
     * @return string
     */
    public function fetch($template, $data = [])
    {
        $data = array_merge($this->defaultVariables, $data);
        return $this->environment->render($template, $data);
    }

    /**
     * Output rendered template
     *
     * @param ResponseInterface $response
     * @param  string $template Template pathname relative to templates directory
     * @param  array $data Associative array of template variables
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, $data = [])
    {
         $response->getBody()->write($this->fetch($template, $data));
         return $response;
    }

    /**
     * Return Handlebars loader
     *
     * @return \Handlebars\Loader\FilesystemLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }
    /**
     * Return Handlebars partials loader
     *
     * @return \Handlebars\Loader\FilesystemLoader
     */
    public function getPartialsLoader()
    {
        return $this->partialsLoader;
    }
    /**
     * Return Twig environment
     *
     * @return \Handlebars\Handlebars
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Does this collection have a given key?
     *
     * @param  string $key The data key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->defaultVariables);
    }
    /**
     * Get collection item for key
     *
     * @param string $key The data key
     *
     * @return mixed The key's value, or the default value
     */
    public function offsetGet($key)
    {
        return $this->defaultVariables[$key];
    }
    /**
     * Set collection item
     *
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function offsetSet($key, $value)
    {
        $this->defaultVariables[$key] = $value;
    }
    /**
     * Remove item from collection
     *
     * @param string $key The data key
     */
    public function offsetUnset($key)
    {
        unset($this->defaultVariables[$key]);
    }

    /**
     * Get number of items in collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->defaultVariables);
    }

    /**
     * Get collection iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->defaultVariables);
    }
    
    /**
     * Creates new Handlebars Helpers.
     *
     */
    public function addHelper($name, $function)
    {
        $env = $this->getInstance();
        $env->addHelper($name,$function);
    }
}
