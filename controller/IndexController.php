<?php

namespace Controller;


use Abstracts\Controller;
use Model\User;
use Model\Wallet;
use Classes\Logger;

class IndexController extends Controller
{
    /**
     * рендерим главную страницу с информацией о пользователе или предложением зарегистрироваться
     * @return mixed
     */
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
        Logger::log('переменная', 'комментарий');
        return $this->view->render('main', $userIdentity);

    }

    /**
     * логиним пользователя и редиректим на главную
     * @return mixed
     */
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


    /**
     * логиним пользователя, даем 10 000 ед. и редиректим на главную
     * @return mixed
     */
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

    /**
     * удаляем сессию пользователя, редирект на главную
     * @return mixed
     */
    public function actionLogout()
    {
        $user = new User();
        $user->logOut();
        $this->view->redirect('/');
    }

    /**
     * логиним пользователя, даем 10 000 ед. и редиректим на главную
     * @return mixed
     */
    public function actionSpend()
    {
        $wallet = new Wallet();
        if(isset($_POST['coins'])) {
            $coins = abs(round(((float)$_POST['coins']), 2));
            $wallet->spendMoney($coins);
        }

        $this->view->redirect('/');
    }

}

