<?php
    require('settings/config.php');
    require(CONTROLLERS.'AppController.php');



    if(isset($_GET['p']) && !empty($_GET['p'])) {
        $param = explode('/', $_GET['p']);
        $controller = $param[0];
        $action = $param[1];

        require(CONTROLLERS.$controller.'.php');

        $controller = new $controller();

        if(method_exists($controller, $action))
            $controller->$action();
        else
            require(ERRORS.'page_404.php');
    }
    else
        require(ERRORS.'page_404.php');