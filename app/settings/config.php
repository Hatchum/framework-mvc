<?php

    define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
    define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

    define('ASSETS', ROOT.'assets/');
    define('LIB', ROOT.'lib/');
    define('SETTINGS', ROOT.'settings/');

    define('MODELS', ROOT.'models/');
    define('VIEWS', ROOT.'views/');
    define('ERRORS', VIEWS.'errors/');
    define('CONTROLLERS', ROOT.'controllers/');
