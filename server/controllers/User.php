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

    /** fonction qui redirige vers la page de recherche
     * 
     */

    public function search() {
        $this->loadModel('Search');
        $this->render('search');
    }


    /** fonction qui verifie si le nom d'utilisateur existe deja
     * @return bool
     */

    public function username_exists() {
        $this->loadModel('Login');
        $usernames = $this->Login->get_usernames();
        foreach($usernames as $username) {
            if($username['username'] === $_POST['username']) {
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

    /** fonction qui crée un mot de passe hashé
     * 
     */

    public function create_hashed_password() {
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
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
                    if(!$this->username_exists()) {
                        $this->create_hashed_password();
                        $this->loadModel('Register');
                        $this->Register->create_user();
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

    /** fonction qui vérifie si le mot de passe est correct pour un utilisateur donné
     * @return bool
     */

    public function verify_password() : bool {
        $this->loadModel('Login');
        $db_password = $this->Login->get_password_by_username()['password'];
        if(password_verify($_POST['password'], $db_password)) {
            return true;
        }
        else {
            return false;
        }
    }



    /** fonction qui check la connexion
     * 
     */

    public function check_login() {
        $data = [];
        $data['message'] = "";
        $data['success'] = 0;
        if($this->username_exists()) {
            if($this->verify_password()) {
                $data['success'] = 1;
                $data['username'] = $_POST['username'];
                $_SESSION['connected'] = 1;
            }
            else {
                $data['message'] = "Mot de passe incorrect";
            }
        }
        else {
            $data['message'] = "L'utilisateur n'existe pas";
        }
        echo json_encode($data);
    }


    /** fonction qui nous deconnecte
     * 
     */

    public function logout() {
        unset($_SESSION['connected']);
        session_destroy();
        $data = [];
        $data['connected'] = 0;
        echo json_encode($data);
    }


    /** fonction qui teste si on est connectés
     * 
     */

    public function is_logged() {
        $data = [];
        if(!isset($_SESSION['connected'])) {
            $data['connected'] = 0;
        }
        else {
            $data['connected'] = 1;
        }
        echo json_encode($data);
    }


}