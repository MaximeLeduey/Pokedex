<?php

class User extends Controller {

    /** fonction qui redirige vers la page login
     * 
     */

    public function login() {
        $this->loadModel('Login');
        $this->render('login');
    }

    /** fonction qui redirige vers la page register
     * 
     */

    public function register() {
        $this->loadModel('Register');
        $this->render('register');
    }


    /** fonction qui verifie si le nom d'utilisateur existe deja
     * @return bool
     */

    public function username_exists() : bool {
        $this->loadModel('Login');
        $usernames = $this->Login->get_usernames();
        foreach($usernames as $username) {
            if($username['username'] == $_POST['username']) {
                return true;
            }
        }

    }

    /** fonction qui check le nom d'utilisateur
     * @return bool
     */

    public function check_username() : bool {
        $username_regex = "/^[a-zA-Z- éè]+$/";
        if(preg_match($username_regex, $_POST['username']) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    /** fonction qui check l'email
     * @return bool
     */

    public function check_email() : bool {
        $email_regex = "/^[a-z0-9\_\-\.]+@[\da-z\.-]+\.[a-z\.]{2,6}$/";
        if(preg_match($email_regex, $_POST['email']) == 1) {
            return true;
        }
        else {
            return false;
        }
    }


    /** fonction qui check le mot de passe
     * @return bool
     */

    public function check_password() : bool {
        $password_regex = "/^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/";
        if(preg_match($password_regex, $_POST['password']) == 1) {
            return true;
        }
        else {
            return false;
        }
    }


    /** fonction qui check l'inscription
     * 
     */

    public function check_register() {
      
        $data = [];
        $data['message'] = "";
        $data['success'] = 0;
        $data['username'] = $_POST['username'];
        $data['email'] = $_POST['email'];
        if($this->check_username()) {
            if($this->check_email()) {
                if($this->check_password()) {
                    if($this->username_exists()) {
                        $data['message'] = "Inscription réussie";
                        $data['success'] = 1;
                    }
                    else {
                        $data['message'] = "Ce nom d'utilisateur est déjà utilisé";
                    }
                }
                else {
                    $data['message'] = "Le mot de passe doit contenir au moins 1 majuscule, 1 minuscule, 1 chiffre et un caractère spécial";
                }
            }
            else {
                $data['message'] = "L'email est incorrect";
            }
        }
        else {
            $data['message'] = "Le nom d'utilisateur ne doit pas contenir de numéros ou de caractères spéciaux";
        }
        echo json_encode($data);

    }


}