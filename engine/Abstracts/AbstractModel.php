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
        $this->db = $this->di->get('db');
    }
}

