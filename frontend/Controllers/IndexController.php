<?php

namespace Frontend\Controllers;

use Engine\Abstracts\AbstractController;

class IndexController extends AbstractController
{
    public function page404()
    {
        echo '404 Page';
    }

    public function index()
    {
        echo 'Index Page';
    }
}
