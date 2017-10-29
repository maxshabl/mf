<?php

namespace Controller;


use Abstracts\Controller;
use Model\User;
use Model\Wallet;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $user = new User();
        //$user->logIn('qqqq', 'qqqq');
        $userIdentity = $user->getUserIdentity();
        if(!empty($userIdentity)){
            $wallet = new Wallet();
            $coins = $wallet->getWallet();
            $userIdentity = array_merge($userIdentity, $coins);
        }
        return $this->view->render('main', $userIdentity);

    }

    public function actionLogin()
    {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $user = new User();
            $user->logIn(trim($_POST['username']), trim($_POST['password']));
            //$userIdentity = $user->getUserIdentity();
            $this->view->redirect('/');
        }
        return $this->view->render('login');
    }

    public function actionRegistration()
    {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $user = new User();
            $user->addUser(trim($_POST['username']), trim($_POST['password']));
            $user->logIn(trim($_POST['username']), trim($_POST['password']));
            $wallet = new Wallet();
            $wallet->addWallet();
            $this->view->redirect('/');
        }
        return $this->view->render('registration');
    }

    public function actionLogout()
    {
        $user = new User();
        $user->logOut();
        $this->view->redirect('/');
    }

    public function actionSpend()
    {

    }







}

