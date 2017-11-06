<?php

namespace Engine\Classes;

/**
 * Class View
 * @package Engine\Classes
 */
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
     * View constructor.
     * @param string $layout
     */
    public function __construct(string $layout)
    {
        $this->path = $layout;
        $this->data = Session::getSessionVar('user') ?? [];
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
