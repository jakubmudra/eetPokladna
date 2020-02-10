<?php


namespace App\Controllers;


use App\Libs\Password;
use App\models\Messages;
use App\models\User;

class LoginController extends Controller
{

    function process($params)
    {
        // TODO: Implement process() method.
        $user = new User();

        if($user->authenticate())
        {
            $this->redirect("dashboard");
        }

        if ($_POST)
        {
            $state = $user->login($_POST['code'], $_POST['password']);
            if ($state) {
                $this->redirect("dashboard");
            }
        }

        $this->setTitle("login");

        $this->setTemplate("auth/login");
    }
}