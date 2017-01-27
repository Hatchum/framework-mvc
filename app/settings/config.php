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

// Database settings

use Symfony\Component\Yaml\Yaml;

$dbSettings = Yaml::parse(file_get_contents(SETTINGS.'database.yml'));

define('DB_TYPE', $dbSettings['parameters']['database_type']);
define('DB_NAME', $dbSettings['parameters']['database_name']);
define('DB_HOST', $dbSettings['parameters']['database_host']);
define('DB_LOGIN', $dbSettings['parameters']['database_login']);
define('DB_PASSWORD', $dbSettings['parameters']['database_password']);
define('DB_CHARSET', $dbSettings['parameters']['database_charset']);

