<?php

namespace Engine\Classes;

use Engine\Interfaces\Service;

/**
 * Class DI
 */
class DI
{
    /**
     * @var array
     */
    private $container = [];


    /**
     * @param string $key
     * @return Service|null
     */
    public function get(string $key)
    {
        return $this->container[$key] ?? null;
    }


    /**
     * @param string $key
     * @param $val
     * @return $this
     */
    public function set(string $key, $val)
    {
        $this->container[$key] = $val;

        return $this;
    }

    /**
     * See if there is a dependency in the container
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]);
    }
}
