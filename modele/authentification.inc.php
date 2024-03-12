<?php

include "$racine/controleur/prompt.php";

class Authentification {
    private $user;

    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->user = null;
    }

    public function login($mailU, $mdpU) {
        $this->user = $utilisateur->getUtilisateurByMailU($mailU);
        if ($this->user && trim($this->user['mdpU']) == trim(crypt($mdpU, $this->user['mdpU']))) {
            $_SESSION["mailU"] = $mailU;
            $_SESSION["mdpU"] = $this->user['mdpU'];
            $_SESSION['username'] = $this->user;
            return true;
        }
        return false;
    }

    public function logout() {
        unset($_SESSION["mailU"]);
        unset($_SESSION["mdpU"]);
        unset($_SESSION['username']);
        $this->user = null;
    }

    public function getMailULoggedOn(){
        if (isset($_SESSION["mailU"])) {
            return $_SESSION["mailU"];
        }
        return "";
    }
        
    public function isLoggedOn() {
        if (isset($_SESSION["mailU"]) && $this->user && $this->user["mailU"] == $_SESSION["mailU"] && $this->user["mdpU"] == $_SESSION["mdpU"]) {
            return true;
        }
        return false;
    }
}