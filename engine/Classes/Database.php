<?php

namespace Engine\Classes;

/**
 * Class Database
 */
/**
 * Class Database
 * @package Engine\Classes
 */
/**
 * Class Database
 * @package Engine\Classes
 */
class Database
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
     * @var self
     */
    protected static $instance;


    /**
     * Возвращает экземпляр класса DB
     * @return self
     */
    public static function getConnection(array $config) : self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }


    /**
     * Возвращает экземпляр класса DB
     * @param array $config
     */
    private function __construct(array $config)
    {
        try {
            $this->dbh = new \PDO(
                $config['dsn'],
                $config['user'],
                $config['password'],
                [\PDO::ATTR_PERSISTENT => true]
            );
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //, \PDO::ATTR_AUTOCOMMIT);
            $this->dbh->setAttribute(\PDO::ATTR_AUTOCOMMIT, 0);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            //$this->dbh->rollBack();
            Logger::log($this->dbh->errorInfo(), 'Ошибка подключения');
        }
    }


    /**
     * Запрос.
     * @param string $sql
     * @param array|null $params
     * @return bool|self::$instance
     */
    public function execute(string $sql, $params = null)
    {
        try {
            $this->sth = $this->dbh->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $this->sth->execute($params);
            return self::$instance;
        } catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo(), 'sql' => $sql, 'params' => $params], 'Ошибка запроса');
            return $this->dbh->rollBack();
        }
    }


    /**
     * @return bool|Database
     */
    public function beginTransaction()
    {
        try {
            $this->dbh->beginTransaction();
        } catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo()], 'Ошибка в начале транзакции');
            return false;
        }
        return self::$instance;
    }


    /**
     * @return bool
     */
    public function commit()
    {
        try {
            $this->dbh->commit();
        } catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo()], 'Ошибка при коммите');
            return $this->dbh->rollBack();
        }
        return true;
    }


    /**
     * @return bool
     */
    public function rollBack()
    {
        $this->dbh->rollBack();
        return false;
    }


    /**
     * @return bool
     */
    public function fetchAll()
    {
        try {
            $result = $this->sth->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            Logger::log(['error' => $this->dbh->errorInfo()], 'Ошибка при fetchAll');
            return $this->dbh->rollBack();
        }
    }


}
