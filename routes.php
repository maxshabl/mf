<?php

$this->router->add('login', '/admin/login/', 'LoginController:login');
$this->router->add('auth-admin', '/admin/auth/', 'LoginController:auth', 'POST');
$this->router->add('dashboard', '/admin/', 'DashboardController:index');
$this->router->add('logout', '/admin/logout/', 'AdminController:logout');
