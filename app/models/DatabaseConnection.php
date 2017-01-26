<?php

namespace App;

use Symfony\Component\Yaml\Yaml;
//use Symfony\Component\Yaml\Exception\ParseException;

class DatabaseConnection
{

    private $params = array();

    public function __construct()
    {
        $this->getParams();
    }

    public function getParams()
    {
        try {
            $this->params = Yaml::parse(file_get_contents(SETTINGS.'database.yml'));
            return $this->params;
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }

}

