<?php


namespace App\models;


use App\Libs\Password;

class User
{
    public function authenticate()
    {
        return ($_SESSION['user']) ?? false;
    }

    public function login($code, $password)
    {
        $user = Db::oneRow("SELECT * FROM users WHERE code = ?", array($code));

        if (!$user || !Password::verify($password, $user["pass_code"])) {
            Messages::addMessage("Bad credentials", "error");
            return false;
        }

        Messages::addMessage("Succesfully logged", "success");
        $_SESSION['user'] = $user;

        return true;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function returnUser()
    {
        return $_SESSION['user'] ?? null;
    }


}