<?php

namespace Engine\Services;

use Engine\Abstracts\AbstractService;
use Engine\Classes\Router\Router;
use Engine\Interfaces\Service;

/**
 * Class RouterService
 */
class RouterService extends AbstractService implements Service
{

    /**
     * @var string
     */
    public $serviceName = 'router';

    /**
     *
     */
    public function init()
    {
        $router = new Router('http://mf.loc/');
        $this->di->set($this->serviceName, $router);
    }
}
