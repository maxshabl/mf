<?php

//declare(strict_types=1);

ini_set("display_errors", 1);

error_reporting(E_ALL);

define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('ENV', 'Frontend');
define('CONF_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR .'config' . DIRECTORY_SEPARATOR);

require_once '../../engine/bootstrap.php';
