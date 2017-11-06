<?php

namespace Engine\Classes\Router;

/**
 * Class DispatchedRoute
 */
class DispatchedRoute
{
    /**
     * @var string
     */
    private $controller = '';
    /**
     * @var array|string
     */
    private $parameters = '';


    /**
     * DispatchedRoute constructor.
     * @param string $controller
     * @param array $parameters
     */
    public function __construct(string $controller, array $parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }


    /**
     * @return string
     */
    public function getController() : string
    {
        return $this->controller;
    }


    /**
     * @return array
     */
    public function getParameters() : array
    {
        return $this->parameters;
    }
}