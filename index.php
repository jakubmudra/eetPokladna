<?php
session_start();
//Set internal encoding
mb_internal_encoding("UTF-8");

//Load autoload
require_once("app/Autoloader.php");
require_once("vendor/autoload.php");

\App\models\Db::connect();

$router = new \App\Controllers\RouterController();
$router->process($_SERVER['REQUEST_URI']);

//Render view
$router->renderView();
