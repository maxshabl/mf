<?php

//автозагрузка composer
require_once 'vendor/autoload.php';

//парсим url
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$partPath = explode( '/', $path);

//в зависимости от GET обращаемся к контроллеру и методам
$controller = $partPath[1] ? 'Controller\\'.$partPath[1].'Controller' : 'Controller\IndexController';
$action = $partPath[2] ? 'action'.$partPath[2] : 'actionIndex';

//вызываем соответствующий контроллер и действие
(new $controller)->{$action}();

