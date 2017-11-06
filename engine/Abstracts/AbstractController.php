<?php

namespace Engine\Abstracts;

use Engine\Classes\DI;

/**
 * Class Controller
 * @package Engine\Abstracts
 */
abstract class AbstractController
{

    /**
     * @var DI
     */
    protected $di;

    /**
     * @var
     */
    protected $db;

    /**
     * @var
     */
    protected $view;

    /**
     * @var
     */
    protected $config;


    /**
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di      = $di;
        $this->db      = $this->di->get('db');
        $this->view    = $this->di->get('view');
        $this->config  = $this->di->get('config');

        $this->initVars();
    }

    /**
     * @param string $key
     * @return array
     */
    public function __get(string $key) : array
    {
        return $this->di->get($key);
    }


    /**
     */
    public function initVars()
    {
        $vars = array_keys(get_object_vars($this));

        foreach ($vars as $var) {
            if ($this->di->has($var)) {
                $this->{$var} = $this->di->get($var);
            }
        }

        return $this;
    }
}
