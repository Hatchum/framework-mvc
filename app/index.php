<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Models\DatabaseConnection;
use Symfony\Component\Yaml\Yaml;

    require('settings/config.php');
    require(CONTROLLERS.'AppController.php');
    require(MODELS.'DatabaseConnection.php');

    if(isset($_GET['p']) && !empty($_GET['p'])) {
        $param = explode('/', $_GET['p']);
        $controller = ucfirst($param[0]);
        $action = $param[1];

        require(CONTROLLERS.$controller.'Controller.php');

        $callController = $controller.'Controller';

        $controller = new $callController();

        if(method_exists($controller, $action))
            $controller->$action();
        else
            require(ERRORS.'page_404.php');
    }
    else {
        require(VIEWS.'home.php');
    }

$db = new DatabaseConnection();

$res1 = $db->selectAll('post');

var_dump($res1);

$res2 = $db->select('test','name,description',['id',2]);
var_dump($res2);

$res3 = $db->select('test', 'description', ['name', 'test 1']);
var_dump($res3);
