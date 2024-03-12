<?php

include_once("modele/bd.critiquer.inc.php");
include_once("modele/authentification.inc.php");
include_once "$racine/controleur/prompt.php";

// On vérifie si les paramètres nécessaires sont présents dans l'URL
if(isset($_GET['idR']) and isset($_GET["note"])){
    // On récupère les paramètres nécessaires
    $idR = $_GET['idR'];
    $note = $_GET['note'];
    $mailU = $authentification->getMailULoggedOn();
    $commentaire  = $_GET['commentaire'];

    // On enregistre la note
    note($idR,$mailU,$note);

    // On redirige l'utilisateur vers la page précédente
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
} else{
    // Si les paramètres nécessaires ne sont pas présents, on affiche un message d'erreur
    echo "Erreur de notation";
}