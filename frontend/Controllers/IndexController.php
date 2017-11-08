<?php

namespace Frontend\Controllers;

use Engine\Abstracts\AbstractController;
use Engine\Classes\Session;
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

        /*if ((new User($this->di))->addUser('username', 'password')) {
           // (new Wallet())->addWallet(1);
        }*/
        $this->view->render('main');
        echo 'Index Page';
    }

    public function login()
    {
        $user = new User($this->di);
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user->login($_POST['username'], $_POST['password']);
        }
        $this->view->render('main', $user);
    }

    public function registration()
    {
        $user = new User($this->di);
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if ((new User($this->di))->addUser('username', 'password')) {
                $user->login($_POST['username'], $_POST['password']);
                $this->view->redirect('/');
            }
        }
        $this->view->render('registration');
    }

    public function logout()
    {
        Session::destroy();
    }
}
