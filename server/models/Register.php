<?php

class Register extends Model {

    public function __construct()
    {
        $this->getConnexion();
    }

    public function create_user() {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$_POST[username]', '$_POST[email]', '$_POST[password]')";
        $this->connexion->exec($sql);
    }


}