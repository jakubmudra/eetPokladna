<?php


namespace App\Controllers;


use App\Config\Config;
use App\models\Messages;
use App\models\User;
use Symfony\Component\Intl\Locale\Locale;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\Intl\IntlExtension;

abstract class Controller
{
    protected array $data = [];
    protected string $view = "";
    protected array $headers = ['title' => '', 'key_words' => '', 'description' => ''];

    abstract function process($params);

    public function renderView()
    {
        $this->data["messages"] = Messages::getMessages();
        if ($this->view)
        {
            $loader = new FilesystemLoader(Config::$templateDirectory);
            $twig = new Environment($loader);
            $twig->addExtension(new IntlExtension());

            $this->setData("this", $this->controller ?? null);

            echo $twig->render($this->view . Config::$templateFileExtension, $this->data);
        }
        Messages::clear();
    }

    protected function checkSecurity()
    {
        $user = new User();

        if(!$user->authenticate()) {
            $this->redirect("login");
        }
    }

    protected function setTitle(string $title)
    {
        $this->setHeader("title", $title);
    }

    protected function setTemplate(string $template)
    {
        $this->view = $template;
    }

    protected function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    protected function getHeader($key)
    {
        return $this->headers[$key];
    }

    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

}