<?php

//require('../settings/config.php');
require(CONTROLLERS.'AppController.php');

class Routeur
{
    private $controllers = array();

    public function __construct(){
        array_push($this->controllers, "TutoController");
    }

    public function routerRequete($param) {
        try {
            if (isset($param) && !empty($param)) {
                $this->envoiView($param);
            } else {
                require(VIEWS . 'home.php');
            }
        }
        catch(Exception $e) {
            $this->gererErreur($e->getMessage());
        }
    }

   public function envoiView(&$param) {
       $controller = ucfirst($param['c']);

       if(!in_array($controller.'Controller', $this->controllers)){
           $this->gererErreur('Le controller \''.$controller.'\' n\'exite pas');
       }
       else {
           require(CONTROLLERS . $controller . 'Controller.php');

           $callController = $controller . 'Controller';

           $controller = new $callController();

           if (!empty($param['a'])) {
               $action = $param['a'];
           }
           else {
               $action = 'index';
           }

           if (method_exists($controller, $action)) {
               $controller->$action();
           }
           else {
               $this->gererErreur('La methode \''.$action.'\' n\'exite pas');
           }
       }
   }

    public function gererErreur($e) {
        $msg['erreur'] = array('msgErreur' => $e);
        extract($msg);
        require(ERRORS . 'page_404.php');
    }
}
