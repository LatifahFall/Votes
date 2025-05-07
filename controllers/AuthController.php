<?php
include_once 'config.php';
include_once 'models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register($username, $password) {
        $this->user->username = $username;
        $this->user->password = $password;
        return $this->user->register() ? "Inscription réussie. <a href='views/login.php'>Se connecter</a>" : "Erreur lors de l'inscription. <a href='views/register.php'>Réessayer</a>";
    }

    public function login($username, $password) {
        $this->user->username = $username;
        $this->user->password = $password;
        if ($this->user->login()) {
            session_start();
            $_SESSION['id'] = $this->user->id;
            $_SESSION['username'] = $this->user->username;
            header("Location: views/vote.php");
            exit();
        } else {
            return "Nom d'utilisateur ou mot de passe incorrect. <a href='views/login.php'>Réessayer</a>";
        }
    }
}
?>
