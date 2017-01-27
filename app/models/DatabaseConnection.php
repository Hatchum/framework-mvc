<?php

namespace App\Models;

/**
 * DatabaseConnection 
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class DatabaseConnection
{

    /**
     * pdo 
     * 
     * @var mixed
     * @access private
     */
    private $pdo;

    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->dbConnection();
    }

    /**
     * dbConnection 
     * 
     * @access private
     * @return void
     */
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

    /**
     * query 
     * 
     * @param mixed $query 
     * @param mixed $params 
     * @access private
     * @return void
     */
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

    /**
     * select 
     * 
     * @param mixed $table 
     * @param mixed $params 
     * @param mixed $conditions 
     * @access public
     * @return void
     */
    public function select($table, $params, $conditions=[])
    {
        if(!empty($conditions)){
            $req = $this->query("SELECT ".$params." FROM ".$table." WHERE ".$conditions[0]." = '".$conditions[1]."'", '')->fetch();
        } else {
            $req = $this->query("SELECT $params FROM $table",'')->fetchAll();
        }
        return $req;
    }

    /**
     * selectAll 
     * 
     * @param mixed $table 
     * @access public
     * @return void
     */
    public function selectAll($table)
    {
        $req = $this->query("SELECT * FROM ".$table)->fetchAll();
        return $req;
    }

}

