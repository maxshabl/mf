<?php

namespace Frontend\Models;

use Engine\Abstracts\AbstractModel;
use Engine\Classes\Logger;
use Engine\Classes\Session;

/**
 * Class User
 */
class User extends AbstractModel
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function addUser(string $username, string $password) : bool
    {
        try {
            $req = $this->sql['addUser'];
            return $this->db->beginTransaction()->execute($req, [
                ':username' => trim($username),
                ':email' => trim($username),
                ':password' => trim($password),
                ':timest1' => time(),
                ':timest2' => time()
            ])->commit();
        } catch (\ErrorException $e) {
            Logger::log($e, 'Ошибка регистрации');
            return false;
        }
    }

    /**
     * @param string $username
     * @param string $password
     * @return array
     */
    public function logIn(string $username, string $password)
    {
        $req = $this->sql['getUser'];
        $params = [
            ':username' => trim($username),
            ':password' => trim($password)
        ];
        $response = $this->db->execute($req, $params)->fetchAll()[0];
        if (isset($req['id'])) {
            return Session::setSessionVar('user', $response);
        }
        return $response;
    }
}
