<?php
//require('../settings/config.php');
class AppController
{
    var $vars = array();

    function set($d) {
        $this->vars = array_merge($this->vars, $d);
    }

    function render($filename) {
        extract($this->vars);
        require(VIEWS.get_class($this).'/'.$filename.'.php');
    }
}