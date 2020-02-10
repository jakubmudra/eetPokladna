<?php


namespace App\models;


class Messages
{
    public static array $types = ["info", "warning", "error", "success"];

    public static function addMessage($message, $type = "info")
    {
        $type = in_array($type, self::$types) ? $type : "info";

        if (strlen($message) > 0)
        {
            $_SESSION["messages"] = $_SESSION["messages"] ?? [];
            $_SESSION["messages"][] = [$message, $type];
        }
    }

    public static function getMessages()
    {
        if (isset($_SESSION["messages"]))
        {
            $messages = $_SESSION["messages"];
            return $messages;
        } else {
            return [];
        }
    }

    public static function clear()
    {
        unset($_SESSION["messages"]);
    }
}