<?php

include_once("./modele/bd.utilisateur.inc.php");
include_once("./modele/authentification.inc.php");
include_once "$racine/controleur/prompt.php";

// Vérification que l'utilisateur est connecté
if (isLoggedOn()) {

    // Vérification que les champs nécessaires sont remplis
    if (isset($_POST['passwd1']) & isset($_POST['passwd2'])) {

        // Récupération des champs et de l'adresse mail de l'utilisateur connecté
        $passwd1 = $_POST['passwd1'];
        $passwd2 = $_POST['passwd2'];
        $mailU = $authentification->getMailULoggedOn();

        // Vérification que les deux mots de passe entrés sont identiques et non vides
        if ($passwd1 == $passwd2 && $passwd1 != "" && $passwd2 != "") {

            // Cryptage du mot de passe
            $crypt = crypt($passwd1, 'sel');

            // Modification du mot de passe dans la base de données
            modifyPassword($mailU, $crypt);

            // Message de confirmation et redirection
            $_SESSION['info'] = "Votre mot de passe a bien été modifié. Déconnexion automatique.";
            header('Location: ./?info=modified');

        } else {
            // Les deux mots de passe ne sont pas identiques ou sont vides
            $_SESSION['info'] = "Erreur, mot de passe non identique ou vide.";
            header('Location: ' . $_SERVER['HTTP_REFERER'] . "&error=password");
        }

    } else {
        // Les champs ne sont pas remplis
        $_SESSION['info'] = "Veuillez remplir tous les champs";
        header('Location: ' . $_SERVER['HTTP_REFERER'] . "&error=password");
    }
}