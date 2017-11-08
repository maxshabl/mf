<?php

namespace Engine\Abstracts;

use Engine\Classes\DI;

/**
 * Class AbstractModel
 */
abstract class AbstractModel
{
    /**
     * @var \Engine\Interfaces\Service|null
     */
    protected $db;

    /**
     * @var mixed
     */
    protected $sql;
    /**
     * @param $di
     */
    public function __construct(DI $di)
    {
        $this->db = $di->get('db');
        $this->sql = require BASE_DIR . 'sql' . DIRECTORY_SEPARATOR . 'sql.php';
    }
}
