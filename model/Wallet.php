<?php

namespace Model;

use Classes\DB;
use Classes\Logger;
use Classes\Session;

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
        $this->userIdentity = Session::getSessionVar('user');
    }


    /**
     * Добавить кошелек
     * @return bool
     */
    public function addWallet()
    {
        $userIdentity = $this->userIdentity;
        if (empty($userIdentity)) {
            return false;
        }
        $money = (float)10000;

        $sql =
            "INSERT INTO 
              `wallet` (`user_id`, `coin`, `created_at`, `updated_at`) 
             VALUES
              (:user_id, :money,  :time1, :time2)";
        $params = [
            ':user_id' => $userIdentity['id'],
            ':money' => $money,
            ':time1' => time(),
            ':time2' => time()

        ];

        $sql2 = "CREATE TABLE `transactions_{$userIdentity['id']}` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) UNSIGNED NOT NULL,
            `tr_uuid` VARCHAR(40) NOT NULL,
            `tr_session` VARCHAR(40) NOT NULL,
            `tr_date` INT(11) NOT NULL,
            `coin` DECIMAL(20,2)  NOT NULL,
            `hash` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`),
            INDEX `FK_user_transactions` (`user_id`),
            CONSTRAINT `FK_user_{$userIdentity['id']}_transactions` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=InnoDB
        ";

        $sql3 =
            "INSERT INTO 
              `transactions_{$userIdentity['id']}` (`user_id`, `tr_uuid`, `tr_session`, `tr_date`,`coin`) 
             VALUES
              (:user_id, :uuid, :tr_session, :tr_date, :coin)";
        $params3 = [
            ':user_id' => $userIdentity['id'],
            ':uuid' => Session::genUuid(),
            ':tr_session' => Session::getSid(),
            ':tr_date' => time(),
            ':coin' => 10000,
        ];
        DB::getConnection()->beginTransaction()->execute($sql, $params)->execute($sql2)->execute($sql3, $params3)->commit();
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
        if (empty($userIdentity)) {
            return false;
        }

        $sql =
            "SELECT sum(`t`.`coin`) as `tr_coin`, `w`.`user_id`, `w`.`coin` 
              FROM `wallet` as `w` 
              INNER JOIN `transactions_{$userIdentity['id']}` as `t` ON `t`.user_id=`w`.`user_id` WHERE `w`.`user_id`=:user_id 

        ";
        $params = [
            ':user_id' => $userIdentity['id'],
        ];
        $query = DB::getConnection()->beginTransaction()->execute($sql, $params);
        $data = $query->fetchAll()[0];
        if ($data['tr_coin'] !== $data['coin']) {
            Logger::log($data, 'Ошибка в данных транзакций.');
            $query->rollBack();
            return false;
        } elseif ($data['coin'] < $coin) {
            Logger::log($data, 'Попытка списать больше, чем есть на счете!');
            $query->rollBack();
            return false;
        }
        $sql1 =
            "UPDATE 
              `wallet` SET `coin`=:coin, updated_at=:updated_at 
               WHERE user_id=:user_id";
        $params1 = [
            ':user_id' => $userIdentity['id'],
            ':coin' => (float)$data['coin']-$coin,
            ':updated_at' => time(),
        ];
        $sql2 =
            "INSERT INTO 
              `transactions_{$userIdentity['id']}` (`user_id`, `tr_uuid`, `tr_session`, `tr_date`,`coin`) 
               VALUES
              (:user_id, :uuid, :tr_session, :tr_date, :coin)";
        $params2 = [
            ':user_id' => $userIdentity['id'],
            ':uuid' => Session::genUuid(),
            ':tr_session' => Session::getSid(),
            ':tr_date' => time(),
            ':coin' => -$coin

        ];
        $query->execute($sql1, $params1)->execute($sql2, $params2)->commit();
        return true;
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
        return DB::getConnection()->execute($sql, $params)->fetchAll()[0]??[];
    }
}
