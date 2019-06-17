<?php
/**
 * Created by PhpStorm.
 * User: Alix
 * Date: 2019-04-04
 * Time: 11:21
 */
namespace App\Src;

use App\Src\Route\Route;
use App\Src\ServiceContainer\ServiceContainer;

class App
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    private $routes = array();

    private $statusCode;

    private $serviceContainer;

    public function __construct(ServiceContainer $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function getService(string $serviceName)
    {
        return $this->serviceContainer->get($serviceName);
    }

    public function setService(string $serviceName, $assigned)
    {
        $this->serviceContainer->set($serviceName, $assigned);
    }

    public  function get(string $pattern, callable $callable)
    {
        $this->registerRoute(self::GET, $pattern, $callable);

        return $this;
    }

    public  function post(string $pattern, callable $callable)
    {
        $this->registerRoute(self::POST, $pattern, $callable);

        return $this;
    }

    public  function put(string $pattern, callable $callable)
    {
        $this->registerRoute(self::PUT, $pattern, $callable);

        return $this;
    }

    public  function delete(string $pattern, callable $callable)
    {
        $this->registerRoute(self::DELETE, $pattern, $callable);

        return $this;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? self::GET;
        $uri = substr($_SERVER['REQUEST_URI'], 16) ?? '/';

        foreach ($this->routes as $route)
        {
            if ($route->match($method, $uri))
            {
                $this->process($route);
            }
        }

        throw new \Error('No routes available for this uri');
    }



    private function process(Route $route)
    {
        try
        {
            http_response_code($this->statusCode);
            echo call_user_func_array($route->getCallable(), $route->getArguments());
        }
        catch (HttpException $e)
        {
            throw $e;
        }
        catch (\Exception $e)
        {
            throw new \Error('There was an error during the processing of your request ');
        }

    }

    private function registerRoute(string $method, string $pattern, callable $callable)
    {
        $this->routes[] = new Route($method, $pattern, $callable);
    }
}
