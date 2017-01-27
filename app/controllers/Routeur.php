<?php

require(ASSETS.'Requete.php');
require(CONTROLLERS.'AppController.php');

class Routeur
{
    public function routerRequete() {
        $requete = new Requete(array_merge($_GET, $_POST));
        var_dump($requete);
        $param = array_merge($_GET, $_POST);
        if (isset($param) && !empty($param['c'])) {
            try {
                $this->envoiView($param);
            }
            catch (Exception $e) {
                $this->gererErreur($e->getMessage());
            }
        } else {
            require(VIEWS . 'home.php');
        }
    }

   public function envoiView(&$param) {
       $controller = ucfirst($param['c']);
       if (file_exists(CONTROLLERS . $controller . 'Controller.php')) {
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
               throw new Exception('La methode \'' . strtoupper($action) . '\' n\'exite pas dans \'' . $callController . '\'');
           }
       }
       else {
           throw new Exception('Le controller \'' . strtoupper($controller) . '\' n\'exite pas');
       }
   }

    public function gererErreur($e) {
        $msg['erreur'] = array('msgErreur' => $e);
        extract($msg);
        require(ERRORS . 'page_404.php');
    }
}
