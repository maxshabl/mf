<?php

$this->router->add('index', '/', 'IndexController:index');
$this->router->add('index', '/index/login', 'IndexController:login');
$this->router->add('index', '/index/logout', 'IndexController:logout');
$this->router->add('index', '/index/registration', 'IndexController:registration');
