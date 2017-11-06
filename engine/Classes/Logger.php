<?php

namespace Engine\Classes;

/**
 * Class Logger
 */
class Logger
{
    /**
     * Записывает лог в папку вне проекта
     * @param mixed $var
     * @param string $comment
     * @param bool $clear
     * @param string|null $path
     * @return bool
     */
    public static function log($var, $comment = '', $clear = false, $path = null)
    {
        if ($var) {
            $date = '====== '.date('Y-m-d H:i:s')." =====\n";
            $comment = $comment."\n";
            $result = $var;
            if (is_array($var) || is_object($var)) {
                $result = print_r($var, 1);
            }
            $result .="\n";
            if (!$path) {
                if (!is_dir(dirname($_SERVER['SCRIPT_FILENAME']) . '/../logs')) {
                    mkdir(dirname($_SERVER['SCRIPT_FILENAME']) . '/../logs');
                }
            }
            $path = dirname($_SERVER['SCRIPT_FILENAME']) . '/../logs/log.txt';
            if ($clear) {
                file_put_contents($path, '');
            }
            @error_log($date.$comment.$result, 3, $path);
            return true;
        }
        return false;
    }
}
