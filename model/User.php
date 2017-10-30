<?php

namespace Model;

use Classes\DB;
use Classes\Session;

class User
{

    /**
     * добавляет юзера
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function addUser(string $username, string $password)
    {
        $timestamp = time();
        $sql =
        "INSERT INTO 
          `user` (`username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at`) 
        VALUES
          (:username, '', :password, :email, $timestamp, $timestamp)";
        $params = [
            ':username' => trim($username),
            ':email' => trim($username),
            ':password' => md5($password)
        ];
        DB::getConnection()->beginTransaction()->execute($sql, $params)->commit();

        return true;
    }

    /**
     * проверка сессии пользователя
     * @return bool
     */
    public function isAuth()
    {
        return !is_null(Session::getSessionVar('user'));
    }

    /**
     * добавляет юзера
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function logIn($username, $password)
    {
        $sql = "
            SELECT `id`, `username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at` FROM `user` 
            WHERE `username` = :username AND `password_hash` = :password
        ";
        $params = [
            ':username' => trim($username),
            ':password' => md5($password)
        ];
        $req = DB::getConnection()->execute($sql, $params)->fetchAll()[0];
        if(isset($req['id'])) {
            return Session::setSessionVar('user', $req);
        }
    }

    /**
     * возвращает сессию пользователя
     * @return array
     */
    public function getUserIdentity()
    {
        return Session::getSessionVar('user')??[];
    }
    public function logOut()
    {
        Session::destroy();
    }
}