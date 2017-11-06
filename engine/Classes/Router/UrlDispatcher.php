<?php

namespace Engine\Classes\Router;

class UrlDispatcher
{
    /**
     * @var array
     */
    private $methods = [
        'GET',
        'POST'
    ];

    /**
     * @var array
     */
    private $routes = [
        'GET'  => [],
        'POST' => []
    ];

    /**
     * @var array
     */
    private $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];


    /**
     * @param string $key
     * @param string $pattern
     */
    public function addPattern(string $key, string $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * @param $method
     * @return array
     */
    private function routes($method) : array
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];
    }

    /**
     * @param $method
     * @param $pattern
     * @param $controller
     */
    public function register(string $method, string $pattern, string $controller)
    {
        $convert = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    /**
     * @param $pattern
     * @return mixed
     */
    private function convertPattern(string $pattern) : string
    {
        if (strpos($pattern, '(') === false) {
            return $pattern;
        }

        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $pattern);
    }

    /**
     * @param $matches
     * @return string
     */
    private function replacePattern(string $matches) : string
    {
        return '(?<' .$matches[1]. '>'. strtr($matches[2], $this->patterns) .')';
    }

    /**
     * @param $parameters
     * @return mixed
     */
    private function processParam($parameters)
    {
        foreach ($parameters as $key => $value) {
            if (is_int($key)) {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }


    /**
     * @param $method
     * @param $uri
     * @return DispatchedRoute
     */
    public function dispatch($method, $uri)
    {
        $routes = $this->routes(strtoupper($method));

        if (array_key_exists($uri, $routes)) {
            return new DispatchedRoute($routes[$uri]);
        }

        return $this->doDispatch($method, $uri);
    }


    /**
     * @param string $method
     * @param string $uri
     * @return DispatchedRoute
     */
    private function doDispatch(string $method, string $uri)
    {
        foreach ($this->routes($method) as $route => $controller) {
            $pattern = '#^' . $route . '$#s';

            if (preg_match($pattern, $uri, $parameters)) {
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }
    }
}
