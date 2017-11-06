<?php
namespace Engine;

use Engine\Classes\Router\DispatchedRoute;
use Engine\Classes\DI;
use Engine\Classes\Common;

/**
 * Class Cms
 * @package Engine
 */
class App
{
    /**
     * @var DI
     */
    private $di;

    /**
     * @var Classes\Router\Router
     */
    public $router;

    /**
     * Cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }


    public function run()
    {
        try {
            require_once BASE_DIR . 'routes.php';

            $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

            if ($routerDispatch == null) {
                $routerDispatch = new DispatchedRoute('IndexController:page404');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\\' . ENV . '\\Controllers\\' . $class;
            $parameters = $routerDispatch->getParameters();

            call_user_func_array([new $controller($this->di), $action], $parameters);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
