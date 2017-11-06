<?php

namespace Engine\Classes;

class Session
{

    /**
     * @param $key
     * @param $val
     * @return array
     */
    public static function setSessionVar($key, $val)
    {
        if (!isset($_SESSION['user'])) {
            ini_set('session.use_strict_mode', 1);
            $sid = md5(self::genUuid());
            session_id($sid);
        }
        session_start();
        $_SESSION[$key] = $val;
        session_write_close();
        return $_SESSION[$key];
    }

    /**
     * @param $key
     * @return array|null
     */
    public static function getSessionVar($key)
    {
        session_start();
        $val = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        session_write_close();
        return $val;
    }

    /**
     * @return string
     */
    public static function getSid() : string
    {
        return session_id();
    }

    /**
     * Уничтожает сессию
     */
    public static function destroy()
    {
        session_start();
        session_destroy();
        session_write_close();
    }

    /**
     * Генерирует uuid
     * @return string
     */
    public static function genUuid() : string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
