<?php

class Login extends Model {

    public function __construct()
    {
        $this->getConnexion();
    }

    public function get_usernames() {
        $sql = "SELECT username FROM `users`";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}