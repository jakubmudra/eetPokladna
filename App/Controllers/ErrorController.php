<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function process($param)
    {
        header("HTTP/1.0 404 Not Found");
        $this->setTitle("404");
        $this->setTemplate("error/404");
    }
}