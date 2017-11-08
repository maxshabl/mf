<?php

return [
        'addUser' => 'INSERT INTO 
          `user` (`username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at`) 
          VALUES
          (:username, "", :password, :email, :timest1, :timest2)',

        'getUser' => 'SELECT `id`, `username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at` FROM `user` 
          WHERE `username` = :username AND `password_hash` = :password',

        'addTransaction' => 'INSERT INTO 
          `transactions` (`user_id`, `tr_uuid`, `tr_session`, `tr_date`,`coin`) 
          VALUES
          (:user_id, :uuid, :tr_session, :tr_date, :coin)',

        'addWallet' => 'INSERT INTO 
          `wallet` (`user_id`, `coin`, `created_at`, `updated_at`)
          VALUES
          (:user_id, :coin, :created_at, :updated_at)',

        'getWallet' => 'SELECT `id` as `wallet_id`, `user_id`, `coin`, `created_at`, `updated_at` FROM `wallet` WHERE `user_id`=:user_id',

        'payment' => [
            'SELECT `wallet`.`coin` FROM `wallet` WHERE `wallet`.`user_id` = :user_id AND `wallet`.`coin` > 0 FOR UPDATE',
            'UPDATE `wallet` SET `wallet`.`coin` = `wallet`.`coin` - :coin WHERE `wallet`.`user_id` = :user_id AND `wallet`.`coin` > 0',
            'INSERT INTO `transactions` (`user_id`, `tr_uuid`, `tr_session`, `tr_date`,`coin`) 
              VALUES (:user_id, :uuid, :tr_session, :tr_date, :coin)'

        ]


];
