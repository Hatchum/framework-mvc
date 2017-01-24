<?php
    define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
    define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
    define('APP', ROOT.'/app/');

    require(APP.'controllers/AppController.php');

    $param = explode('/', $_GET['p']);
var_dump(ROOT);
var_dump($param);
    $controller = $param[0];
    $action = $param[1];

    require('app/controllers/'.$controller.'.php');

    $controller = new $controller();

    if(method_exists($controller, $action))
        $controller->$action();
    else
        echo 'error 404';
        //http_redirect('app/errors/404.php');