<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Engine\App;
use Engine\Classes\DI;

try{
    // Dependency injection
    $di = new DI();
    $services = require CONF_DIR . 'services.php';

    // Init services
    foreach ($services as $service) {
        $provider = new $service($di);

        /** @var \Engine\Abstracts\AbstractProvider $provider */
        $provider->init();
    }


    $app = new App($di);
    $app->run();

} catch (\ErrorException $e) {
    echo $e->getMessage();
}
