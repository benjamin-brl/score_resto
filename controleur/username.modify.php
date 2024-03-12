<?php

include_once("./modele/bd.utilisateur.inc.php");
include_once("./modele/authentification.inc.php");
include_once "$racine/controleur/prompt.php";

// Vérification si l'utilisateur est connecté
if ($authentification->isLoggedOn()) {
    // Vérification si un nouveau pseudo a été envoyé
    if (isset($_POST['pseudoU'])) {
        $pseudoU = $_POST['pseudoU'];
        $mailU = $authentification->getMailULoggedOn();
        // Modification du pseudo de l'utilisateur connecté
        modifyUsername($mailU, $pseudoU);
        // Redirection vers la page précédente avec message d'information sur la modification
        header('Location: ' . $_SERVER['HTTP_REFERER'].'&info=modified');
    } else {
        // Redirection vers la page précédente si aucune modification n'a été faite
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}