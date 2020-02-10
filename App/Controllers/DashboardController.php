<?php


namespace App\Controllers;


use App\models\User;

class DashboardController extends Controller
{

    function process($params)
    {
        $user = new User();

        $this->checkSecurity();

        if (!empty($params[0]) && $params[0] == 'logout')
        {
            $user->logout();
            $this->redirect("login");
        }

        $this->setTitle("Dashboard");
        $this->setTemplate("dashboard");
    }
}