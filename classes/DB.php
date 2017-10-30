<?php

namespace Classes;


class DB
{

    /**
     * Соединение с базой
     * @var
     */
    private $dbh;


    /**
     * @var
     */
    private $sth;


    /**
     * Экземпляр класса DB
     * @var DB
     */
    public static $instance;


    /**
     * Возвращает экземпляр класса DB
     * @return DB
     */
    public static function getConnection() : self
    {
        if(empty(self::$instance))
            self::$instance = new self;

        return self::$instance;
    }


    /**
     * Возвращает экземпляр класса DB
     */
    private function __construct()
    {
        $config = require (__DIR__.'\..\config\config.php');
        try {
            $this->dbh = new \PDO($config['db']['dsn'], $config['db']['user'], $config['db']['password'], [\PDO::ATTR_PERSISTENT => true]);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //, \PDO::ATTR_AUTOCOMMIT);
            $this->dbh->setAttribute(\PDO::ATTR_AUTOCOMMIT,0);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            //$this->dbh->rollBack();
            Logger::log($this->dbh->errorInfo(), 'Ошибка подключения');
            exit();
        }

    }


    /**
     * Запрос.
     * @param $sql
     * @param $params
     * @return self::$instance
     */
    public function execute($sql, $params)
    {
        try {
            $this->sth = $this->dbh->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $this->sth->execute($params);
            return self::$instance;
        }catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo(), 'sql' => $sql, 'params' => $params], 'Ошибка запроса');
            $this->dbh->rollBack();
            exit();
        }

    }


    /**
     * Начало транзакции
     * @return self::$instance
     */
    public function beginTransaction()
    {
        $this->dbh->beginTransaction();

        return self::$instance;
    }


    /**
     * Коммит
     * @return self::$instance
     */
    public function commit()
    {
        try {
            $this->dbh->commit();
        }catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo()], 'Ошибка при коммите');
            $this->dbh->rollBack();
            exit();
        }
        return self::$instance;
    }

    /**
     * Откат транзакции
     * @return self::$instance
     */
    public function rollBack()
    {
        $this->dbh->rollBack();

        return self::$instance;
    }


    /**
     * получить разультат запроса
     * @return array
    */
    public function fetchAll()
    {
        try {
            $result = $this->sth->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo()], 'Ошибка при fetchAll');
            $this->dbh->rollBack();
        }

    }


    /**
     * Запрещаем клонирование
     */
    private function __clone() {}

}