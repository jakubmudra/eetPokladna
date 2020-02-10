<?php


namespace App;


class Autoloader
{
    /**
     * Base Autoloader function
     *
     * @param $className
     * @return bool
     */
    static public function loader($className) {
        $filename = str_replace("\\", '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

spl_autoload_register('App\Autoloader::loader');