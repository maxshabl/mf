<?php

namespace Engine\Abstracts;

use Engine\Classes\DI;

abstract class AbstractModel
{
    protected $db;

    /**
     * @param $di
     */
    public function __construct(DI $di)
    {
        $this->db = $di->get('db');
        $this->sql = require BASE_DIR . 'sql' . DIRECTORY_SEPARATOR . 'sql.php';
    }
}
