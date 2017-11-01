<?php

namespace Classes;

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
     * получаем значения из конфигурации
     */
    public function __construct()
    {
        $config = require(__DIR__.'\..\config\config.php');
        $this->path = $config['layout'];
        $this->data = Session::getSessionVar('user')??[];
    }

    /**
     * Рендерит представление и передает в него переменные
     * @param mixed $view
     * @param mixed $params
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
        header('Location:'.$action);
        exit;
    }





}