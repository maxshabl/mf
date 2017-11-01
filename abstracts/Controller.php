<?php

namespace Abstracts;

use Classes\View;

abstract class Controller
{

    /**
     * экземпляр представления
     * @var
     */
    protected $view;


    /**
     * Создаем экземпляр пердставления и помещаем в переменную view
     */
    public function __construct()
    {
        $this->view = new View();
    }
}
