<?php

include_once("modele/bd.critiquer.inc.php");
include_once "$racine/controleur/prompt.php";

// Vérification si l'utilisateur est un admin
$admin = isAdmin($authentification->getMailULoggedOn());

session_start();

// Si l'utilisateur est un admin
if($admin !=false){
    // Vérification de l'existence et de la non-vacuité des paramètres idR et mailU dans l'URL
    if(isset($_GET['idR']) && isset($_GET['mailU']) && !empty($_GET['idR']) && !empty($_GET['mailU'])){
        
        // Récupération des paramètres idR et mailU dans l'URL
        $idR = $_GET['idR'];
        $mailU = $_GET['mailU'];

        // Suppression de la critique correspondante
        deleteCritique($idR, $mailU);

        // Redirection vers la page précédente
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

// Vérification de l'existence et de la non-vacuité du paramètre idR dans l'URL
if (isset($_GET["idR"]) && !empty($_GET["idR"])) {
    
    // Récupération du paramètre idR dans l'URL
    $idR = $_GET["idR"];

    // Vérification si l'utilisateur est connecté
    if (isset($_SESSION["mailU"])) {
        $mailU = $_SESSION["mailU"];
    } else {
        $mailU = $_COOKIE["mailU"];
        // Redirection vers la page précédente si l'utilisateur n'est pas connecté
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    };

    // Suppression de la critique correspondante
    deleteCritique($idR, $mailU);

    // Redirection vers la page précédente
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
} else {
    // Message d'erreur si l'identifiant de critique n'est pas transmis
    $msg = "Erreur : aucun identifiant de critique n'a été transmis pour suppression.";
}