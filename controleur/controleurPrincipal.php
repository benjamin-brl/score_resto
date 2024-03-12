<?php

class ControllerPrincipal {
    private $actions = [
        "defaut" => "listeRestos.php",
        "liste" => "listeRestos.php",
        "detail" => "detailResto.php",
        "recherche" => "rechercheResto.php",
        "connexion" => "connexion.php",
        "deconnexion" => "deconnexion.php",
        "profil" => "monProfil.php",
        "supprimerCritique" => "delete.critique.php",
        "addCritique" => "ajouterCritique.php",
        "aimer" => "aimer.php",
        "noter" => "noter.php",
        "modifierCritique" => "modifierCritique.php",
        "updProfil" => "modifierProfil.php",
        "aimerType" => "like.cuisine.php",
        "modifyUsername" => "username.modify.php",
        "passwordModify" => "passwd.modify.php",
        "cgu" => "cgu.php",
        "adminTools" => "adminTools.php",
        "deleteCritiqueAdmin" => "delete.critique.admin.php",
        "inscription" => "inscription.php",
        "adminDeleteAccount" => "admin.deleteAccount.php",
        "adminModifyAccount" => "admin.modifyAccount.php",
        "confirm" => "confirm.php",
        "infoCompte" => "infoCompte.php",
        "voirProfil" => "voirProfil.php"
    ];

    public function getAction($action) {
        return array_key_exists($action, $this->actions) ? $this->actions[$action] : $this->actions["defaut"];
    }
}