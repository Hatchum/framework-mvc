<?php

class TutoController extends AppController
{
    function index() {
        $d['tuto'] = array('nom'=>'toto');
        $this->set($d);
        $this->render('index');
    }
}