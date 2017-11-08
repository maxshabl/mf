<?php
namespace Frontend\Models;

use Engine\Abstracts\AbstractModel;
use Engine\Classes\Logger;
use Engine\Classes\Session;

/**
 * Class Wallet
 */
class Wallet extends AbstractModel
{
    /**
     * @return bool
     */
    public function addWallet()
    {
        $userData = Session::getSessionVar('user');
        try {
            $req1 = $this->sql['addWallet'];
            $req2 = $this->sql['addTransaction'];
            return $this->db->beginTransaction()
                ->execute($req1, [
                    ':user_id' => $userData['id'],
                    ':coin' => 10000,
                    ':created_at' => time(),
                    ':updated_at' => time()
                ])
                ->execute($req2, [
                ':user_id' => $userData['id'],
                ':uuid' => Session::genUuid(),
                ':tr_session' => Session::getSid(),
                ':tr_date' => time(),
                ':coin' => 10000,
            ])->commit();
        } catch (\ErrorException $e) {
            Logger::log($e, 'Ошибка добавления кошелька');
            return false;
        }
    }


    /**
     * @param array $session
     * @return array
     */
    public function getWallet(array $session)
    {
        $req = $this->sql['getWallet'];
        $params = [
            ':user_id' => $session['id']
        ];
        $response = $this->db->execute($req, $params)->fetchAll()[0];
        if (isset($response['id'])) {
            return Session::setSessionVar('user', $response);
        }
        return $response;
    }

    /**
     * @param array $session
     * @param int $coin
     * @return mixed
     */
    public function spendMoney(array $session, int $coin)
    {
        $req = $this->sql['payment'];
        $params = [
            ':user_id' => $session['id']
        ];
        $params1 = [
            ':user_id' => $session['id'],
            ':coin' => $coin,
        ];
        $params2 = [
            ':user_id' => $session['id'],
            ':uuid' => Session::genUuid(),
            ':tr_session' => Session::getSid(),
            ':tr_date' => time(),
            ':coin' => -$coin,
        ];
        $transaction =  $this->db->beginTransaction()
            ->execute($req[0], $params);
        $blocked = clone $transaction;
        $blockedData = $blocked->fetchAll()[0];
        if (isset($blockedData['coin']) && $blockedData['coin'] === 0 || $coin > $blockedData['coin']) {
            return  $transaction->rollBack();
        }
        return $transaction->execute($req[1], $params1)->execute($req[2], $params2)->commit();
    }
}
