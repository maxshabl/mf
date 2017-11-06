<?php

namespace Engine\Abstracts;

use Engine\Classes\DI;
use Engine\Interfaces\Service;

/**
 * Class AbstractProvider
 */
abstract class AbstractService
{
    /**
     * @var DI
     */
    protected $di;

    /**
     * AbstractProvider constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    abstract public function init();
}
