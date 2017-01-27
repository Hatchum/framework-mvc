<?php

namespace App;

use Symfony\Component\Yaml\Yaml;

class DatabaseConnection
{

    private $pdo;

    public function __construct()
    {
        $this->dbConnection();
    }

    private function dbConnection()
    {
        try {
            $this->pdo = new \PDO(DB_TYPE.":dbname=".DB_NAME.";host=".DB_HOST.";charset=".DB_CHARSET, DB_LOGIN, DB_PASSWORD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo 'Erreur de connection';
        }

    }

    private function query($query, $params=null)
    {
        if (!empty($params)){
            $req = $this->pdo->prepare($query);
            $req->execute($params);
        }else {
            $req = $this->pdo->query($query);
        }
        return $req;
    }

    public function select($table, $params, $conditions=[])
    {
        if(!empty($conditions)){
            $req = $this->query("SELECT ".$params." FROM ".$table." WHERE ".$conditions[0]." = '".$conditions[1]."'", '')->fetch();
        } else {
            $req = $this->query("SELECT $params FROM $table",'')->fetchAll();
        }
        return $req;
    }

    public function selectAll($table)
    {
        $req = $this->query("SELECT * FROM ".$table)->fetchAll();
        return $req;
    }

}

