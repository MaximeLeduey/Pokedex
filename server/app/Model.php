<?php

abstract class Model {

    private $host = "localhost";
    private $db_name = "pokedex";
    private $username = "root";
    private $password = "";

    protected $connexion;

    public $table;
    public $id;

    public function getConnexion() {
        $this->connexion = null;

        try {
            $this->connexion = new PDO('mysql:host='. $this->host .';dbname='. $this->db_name, $this->username, $this->password);
            $this->connexion->exec('set names utf8');
        }
        catch(PDOException $exception) {
            echo "Erreur". $exception->getMessage();
        }
    }

    // public function getAll() {
    //     $sql = 'SELECT * FROM '.$this->table;
    //     $query = $this->connexion->prepare($sql);
    //     $query->execute();
    //     return $query->fetchAll();
    // }

    // public function getOne() {
    //     $sql = 'SELECT * FROM '.$this->table.' WHERE user_id = '.$this->id;
    //     $query = $this->connexion->prepare($sql);
    //     $query->execute();
    //     return $query->fetch();
    // }

}