<?php

namespace Model;

use Classes\DB;
use Classes\Session;

class User
{

    public function addUser($email, $password)
    {

        $timestamp = time();
        $sql =
        "INSERT INTO 
          `user` (`username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at`) 
        VALUES
          (:username, '', :password, :email, $timestamp, $timestamp)";
        $params = [
            ':username' => trim($email),
            ':email' => trim($email),
            ':password' => md5($password)
        ];
        DB::getConnection()->beginTransaction()->execute($sql, $params)->commit();
    }

    public function isAuth()
    {
        return !is_null(Session::getSessionVar('user'));
    }


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

    public function getUserIdentity()
    {
        return Session::getSessionVar('user')??[];
    }
    public function logOut()
    {
        Session::destroy();
    }
}