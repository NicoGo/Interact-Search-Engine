<?php

namespace etuapp\utils;

use \PDO;

class Database{

    /**
    * Objet Database Singleton
    */
    private static $obj = null; 
    /**
    * Objet PDO
    */
    private $pdo;

    /**
    * Instancie l'objet et initialise la BDD
    * @param $login - login BDD
    * @param $password - password BDD
    * @param $database_name - nom BDD
    * @param $host - host BDD
    */
    private function __construct($login, $password, $database_name, $host = 'localhost'){
        $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
    * Retourne/Instancie la classe -> Singleton
    * @return l'instance en attribut
    */
    public static function getInstance()
    {
        if(is_null(self::$obj)) {
            self::$obj=new Database("root","","interact");
        }
        return self::$obj;
    }

    /**
    * Permet de faire une requete de type COUNT
    * @param $statement - requete SQL
    * @return le compte de lignes 
    */
    public function count($statement)
    {
        $req = $this->pdo->query($statement);
        $data = $req->fetchColumn();
        return $data;
    }

    /**
    * Permet de faire une requete de type COUNT
    * @param $statement - requete SQL
    * @return le compte de lignes 
    */
    public function query($statement, $class_name,$one=false){
        if($one) {
            $req = $this->pdo->query($statement);
            $req->setFetchMode(PDO::FETCH_CLASS,$class_name);
            $data = $req->fetch();
            return $data;
        }
        else {
            $req = $this->pdo->query($statement);
            $req->setFetchMode(PDO::FETCH_CLASS,$class_name);
            $data = $req->fetchAll();
            return $data;
        } 
    }

    /**
    * Permet de faire une requete prepare / query en fonction des arguments
    * @param $statement - requete SQL
    * @param $attributes - tableau de valeurs en cas de requete préparée
    * @param class_name - nom de la classe qui va etre instanciée en résultat
    * @param $one - si true -> renvoie classe sinon tableau de classe
    * @return une classe ou un tableau de classe - si insert / update / delete alors le resultat de la requete
    */
    public function prepare($statement,$attributes,$class_name,$fetch=false)
    {
        $req = $this->pdo->prepare($statement);
        $result = $req->execute($attributes);

        //  SI C'EST UNE REQUETE TYPE INSERT DELETE UPDATE

        if(strpos($statement, 'DELETE')===0 || strpos($statement, 'INSERT')===0 || strpos($statement, 'UPDATE')===0) {
            return $result;
        }

        $req->setFetchMode(PDO::FETCH_CLASS,$class_name);

        if ($fetch) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }

        return $data;
    }

    /** 
    * Renvoie le dernier ID insérer dans la BDD
    * @return dernier id inséré
    **/
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}