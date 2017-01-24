<?php

class AppController
{
    var $vars = array();

    function set($d) {
        $this->vars = array_merge($this->vars, $d);
    }

    function render($filename) {
        extract($this->vars);
        require(APP.'views/'/*.get_class($this).'/'*/.$filename.'.php');
    }
}