<?php
namespace Engine\Services;

use Engine\Abstracts\AbstractService;
use Engine\Classes\Database;
use Engine\Classes\DI;
use Engine\Interfaces\Service;

/**
 * Class DatabaseService
 */
class DatabaseService extends AbstractService implements Service
{


    /**
     * @var string
     */
    public $serviceName = 'db';


    /**
     * @return DatabaseService
     */
    public function init() : DatabaseService
    {
        $config = include CONF_DIR . 'database.php';
        $this->di->set($this->serviceName, Database::getConnection($config['db']));

        return $this;
    }
}