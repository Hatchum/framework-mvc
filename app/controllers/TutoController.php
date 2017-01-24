<?php

class TutoController extends AppController
{
    function index() {
        $d['tuto'] = array('nom'=>'Moi');
        $this->set($d);
        $this->render('index');
    }
}