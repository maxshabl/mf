<?php

namespace Frontend\Controllers;

use Engine\Abstracts\AbstractController;
use Engine\Classes\Session;
use Frontend\Models\User;
use Frontend\Models\Wallet;

/**
 * Class IndexController
 */
class IndexController extends AbstractController
{
    /**
     *
     */
    public function page404()
    {
        echo '404 Page';
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $wallet = new Wallet($this->di);
        $wallet->spendMoney(['id' => 16], 8);
        $userSession = Session::getSessionVar('user');
        if (!empty($userSession)) {
            $wallet = new Wallet($this->di);
            $walletData = $wallet->getWallet(Session::getSessionVar('user'));
            return $this->view->render('main', $walletData);
        }
        return $this->view->render('main');
    }

    /**
     * @return mixed
     */
    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])
                && $_POST['username'] != '' && $_POST['password'] != '') {
            $user = new User($this->di);
            $user->login($_POST['username'], $_POST['password']);
            $this->view->redirect('/');
        }
        return $this->view->render('login');
    }

    /**
     * @return mixed
     */
    public function registration()
    {
        if (isset($_POST['username']) && isset($_POST['password'])
            && $_POST['username'] != '' && $_POST['password'] != '') {
            $user = new User($this->di);
            if ($user->addUser($_POST['username'], $_POST['password'])) {
                $user->login($_POST['username'], $_POST['password']);
                (new Wallet($this->di))->addWallet();
                return $this->view->redirect('/');
            }
        }
        return $this->view->render('registration');
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        Session::destroy();
        return $this->view->redirect('/');
    }

    /**
     * @return mixed
     */
    public function spend()
    {
        $userSession = Session::getSessionVar('user');
        if (!empty($userSession) && isset($_POST['coins'])) {
            $coin = abs(((int)$_POST['coins']));
            $wallet = new Wallet($this->di);
            $wallet->spendMoney($userSession, $coin);
        }
        return $this->view->redirect('/');
    }
}
