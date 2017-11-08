<?php

$this->router->add('index', '/', 'IndexController:index');
$this->router->add('loginPage', '/index/login', 'IndexController:login', 'GET');
$this->router->add('login', '/index/login', 'IndexController:login', 'POST');
$this->router->add('logout', '/index/logout', 'IndexController:logout');
$this->router->add('registrationPage', '/index/registration', 'IndexController:registration', 'GET');
$this->router->add('registration', '/index/registration', 'IndexController:registration', 'POST');
$this->router->add('spend', '/index/spend', 'IndexController:spend', 'POST');
