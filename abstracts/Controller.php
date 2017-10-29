<?php

namespace Abstracts;


use Classes\View;

abstract class Controller
{

    protected $view;


    public function __construct()
    {
        $this->view = new View();
    }
}