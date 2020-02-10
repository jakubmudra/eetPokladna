<?php


namespace App\Controllers;


use App\Config\Config;
use http\Url;

class RouterController extends Controller
{
    protected Controller $controller;

    /**
     * Router processing method. Sets default attr.
     *
     * @param $params REQUEST_URI from SERVER var.
     */
    public function process($params)
    {
        $parsedURL = $this->parseURL($params);
        $controllerClass =  Config::$controllerNamespace . ucfirst($this->parseClassName( array_shift( $parsedURL)) . "Controller" );
        $filename = str_replace("\\", '/', $controllerClass) . ".php";

        if (get_parent_class($this) === $controllerClass) {
            $this->controller = new LoginController();
        }else if (file_exists($filename)) {
            $this->controller = new $controllerClass;
        } else {
            $this->redirect('error');
        }

        $this->controller->process($parsedURL);

        $this->setData("title", $this->controller->getHeader("title"));
        $this->setData("desc", $this->controller->getHeader("description"));

        $this->setTemplate("baseLayout");
    }

    private function parseClassName($param)
    {
        $string = str_replace(' ', '', ucwords(str_replace('-', ' ', $param)));
        return $param;
    }

    private function parseURL($url)
    {
        $parsedURL = parse_url($url);
        $parsedURL["path"] = ltrim($parsedURL["path"], "/");
        $parsedURL["path"] = trim($parsedURL["path"]);

        return explode("/", $parsedURL["path"]);

    }
}