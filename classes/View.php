<?php

namespace Classes;

use Model\User;

class View
{

    /**
     * Путь к представлению
     * @var
     */
    protected $path;

    /**
     * @var
     */
    protected $data;

    /**
     */
    public function __construct()
    {
        $config = require (__DIR__.'\..\config\config.php');
        $this->path = $config['layout'];
        $this->data = Session::getSessionVar('user')??[];
        $a = [];

    }

    /**
     * Рендерит представление и передает в него переменные
     * @param mixed $view
     * @param mixed $params
     * @return string
     */
    public function render($view, $params = [])
    {
        $params = array_merge($this->data, $params);
        foreach ($params as $k => $v) {
            $$k = $v;
        }
        ob_start();
        include($this->path .  $view . '.php');
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }
    /**
     * Редирект к указанному контроллеру
     * @param string $action
     */
    public function redirect(string $action)
    {
        $a = $_SERVER['SERVER_NAME'].$action;
        header('Location:'.$action);
        exit;
    }





}