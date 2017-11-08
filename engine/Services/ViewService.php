<?php

namespace Engine\Services;

use Engine\Abstracts\AbstractService;
use Engine\Classes\View;
use Engine\Interfaces\Service;

/**
 * Class ViewService
 */
class ViewService extends AbstractService implements Service
{

    /**
     * @var string
     */
    public $serviceName = 'view';


    /**
     *
     */
    public function init()
    {
        $layout = include CONF_DIR . 'config.php';
        $view = new View($layout['layout']);
        $this->di->set($this->serviceName, $view);
    }
}
