<?php

namespace Model;


use Classes\DB;
use Classes\Session;
use Model\User;

class Wallet
{

    /**
     * сессия пользователя
     * @var
    */
    private $userIdentity;


    /**
     * получаем сессию пользователя
     */
    public function __construct()
    {
        $this->userIdentity = (new User())->getUserIdentity();
    }


    /**
     * Добавить кошелек
     * @return bool
     */
    public function addWallet()
    {
        $userIdentity = $this->userIdentity;
        if(empty($userIdentity)) return false;
        $timestamp = time();
        $sql =
            "INSERT INTO 
              `wallet` (`user_id`, `coin`, `created_at`, `updated_at`) 
             VALUES
              (:user_id, 10000,  $timestamp, $timestamp)";
        $params = [
            ':user_id' => $userIdentity['id']
        ];
        $sql2 =
            "INSERT INTO 
              `transactions` (`user_id`, `tr_uuid`, `tr_session`, `tr_date`,`coin`) 
             VALUES
              (:user_id, :uuid, :tr_session, :tr_date, :coin)";
        $params2 = [
            ':user_id' => trim($userIdentity['id']),
            ':uuid' => Session::genUuid(),
            ':tr_session' => Session::getSid(),
            ':tr_date' => time(),
            ':coin' => 10000
        ];
        DB::getConnection()->beginTransaction()->execute($sql, $params)->execute($sql2, $params2)->commit();
        return true;

    }

    /**
     * Потратить деньги
     * @param float
     * @return bool
     */
    public function spendMoney(float $coin)
    {
        $userIdentity = $this->userIdentity;
        if(empty($userIdentity)) return false;

        // запрашиваем сумму в кошельке
        $wallet = $this->getWallet();
        $sql =
            "UPDATE 
              `wallet` SET `coin`=:coin, updated_at=:updated_at 
               WHERE user_id=:user_id";
        $params = [
            ':user_id' => $userIdentity['id'],
            ':coin' => $wallet['coin'] - $coin,
            ':updated_at' => time(),
        ];
        $sql2 =
            "INSERT INTO 
              `transactions` (`user_id`, `tr_uuid`, `tr_session`, `tr_date`,`coin`) 
               VALUES
              (:user_id, :uuid, :tr_session, :tr_date, :coin)";
        $params2 = [
            ':user_id' => $userIdentity['id'],
            ':uuid' => Session::genUuid(),
            ':tr_session' => Session::getSid(),
            ':tr_date' => time(),
            ':coin' => -$coin

        ];
        $sql3 =
            "SELECT sum(`t`.`coin`) as `tr_coin`, `w`.`user_id`, `w`.`coin` 
              FROM `wallet` as `w` 
              INNER JOIN `transactions` as `t` ON `t`.user_id=`w`.`user_id` WHERE `w`.`user_id`=:user_id 

        ";

        $params3 = [
            ':user_id' => $userIdentity['id'],
        ];

        $query = DB::getConnection()->beginTransaction()->execute($sql, $params)->execute($sql2, $params2)->execute($sql3, $params3);
        $coinData = $query->fetchAll()[0];
        if($coinData['tr_coin'] === $coinData['coin']) {
            $query->commit();
            return true;
        } else {
            $query->rollBack();
            return false;
        }
    }


    /**
     * Получить информацию по кошельку из базы
     * @return array
     */
    public function getWallet()
    {
        $sql = "
             SELECT `user_id`, `coin`, `created_at`, `updated_at` 
                FROM `wallet` 
                WHERE `user_id` = :user_id   
        ";
        $params = [
            ':user_id' => trim($this->userIdentity['id'])
        ];
        return DB::getConnection()->execute($sql, $params)->fetchAll()[0];
    }
}