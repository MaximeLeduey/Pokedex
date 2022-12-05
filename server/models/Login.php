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

    public function get_password_by_username() {
        $sql = "SELECT password FROM `users`WHERE username = '$_POST[username]'";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }


}