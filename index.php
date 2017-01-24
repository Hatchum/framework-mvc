<?php
    require('config.php');
    require(APP.'controllers/AppController.php');

    if(isset($_GET['p']) && !empty($_GET['p'])) {
        $param = explode('/', $_GET['p']);
        $controller = $param[0];
        $action = $param[1];

        require('app/controllers/'.$controller.'.php');

        $controller = new $controller();

        if(method_exists($controller, $action))
            $controller->$action();
        else
            require(APP.'errors/page_404.php');
    }
    else
        require(APP.'errors/page_404.php');