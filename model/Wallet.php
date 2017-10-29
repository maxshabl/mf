<?php

namespace Model;


use Classes\DB;
use Classes\Session;

class Wallet
{
    public function addWallet(User $user)
    {
        $userIdentity = $user->getUserIdentity();
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

    }

    public function spendMoney()
    {

    }

    public function getWallet()
    {

    }
}