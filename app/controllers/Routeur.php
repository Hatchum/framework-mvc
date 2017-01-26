<?php

//require('../settings/config.php');
require(CONTROLLERS.'AppController.php');

class Routeur
{
    private $controllers = array();

    public function __construct(){
        array_push($this->controllers, "TutoController");
    }

    public function routerReq($route) {
        if(isset($route['p']) && !empty($route['p'])) {
            $param = explode('/', $route['p']);
            $controller = ucfirst($param[0]);

            if(!array_key_exists($controller.'Controller', $this->controllers)){
                require(ERRORS . 'page_404.php');
            }
            else {
                if (!empty($param[1])) {
                    $action = $param[1];
                } else {
                    $action = 'index';
                }

                require(CONTROLLERS . $controller . 'Controller.php');

                $callController = $controller . 'Controller';

                $controller = new $callController();

                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    require(ERRORS . 'page_404.php');
                }
            }
        }
        else {
            require(VIEWS.'home.php');
        }
    }
}
