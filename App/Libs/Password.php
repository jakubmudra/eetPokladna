<?php


namespace App\Libs;


use App\models\Messages;

class Password
{
    public static array $options = [
        "cost" => 10
    ];

    public static function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, self::$options);
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function generate()
    {
        return rand(1000, 9999);
    }
}