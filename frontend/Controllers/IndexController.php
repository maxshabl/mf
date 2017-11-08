<?php

namespace Frontend\Controllers;

use Engine\Abstracts\AbstractController;
use Frontend\Models\User;
use Frontend\Models\Wallet;

class IndexController extends AbstractController
{
    public function page404()
    {
        echo '404 Page';
    }

    public function index()
    {
        if ((new User($this->di))->addUser('username', 'password')) {
            (new Wallet())->addWallet(1);
        }

        echo 'Index Page';
    }
}
