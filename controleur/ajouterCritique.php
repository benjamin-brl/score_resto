<?php

include_once "$racine/controleur/prompt.php";
include_once("modele/bd.critiquer.inc.php"); // inclusion de la classe gérant la base de données des critiques
include_once("modele/authentification.inc.php"); // inclusion de la classe gérant l'authentification des utilisateurs

// Vérification si une critique a été passée en méthode POST
if (isset($_POST['critique'])) {
    $critique = $_POST['critique'];
} else {
    $errorMsg = "Aucune critique passée en méthode POST"; // Si aucune critique n'a été passée, on envoie un message d'erreur
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Et on redirige l'utilisateur vers la page précédente
    die(); // on arrête le script
}

// Vérification si l'identifiant de restaurant est présent en paramètre GET
if (isset($_GET['idR'])) {

    $mailU = getMailULoggedOn(); // Récupération de l'adresse email de l'utilisateur connecté
    $idR = $_GET['idR']; // Récupération de l'identifiant de restaurant passé en paramètre GET

    addCritique($idR, $mailU, $critique); // Ajout de la critique dans la base de données avec l'identifiant de restaurant et l'adresse email de l'utilisateur
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirection de l'utilisateur vers la page précédente

} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Si l'identifiant de restaurant n'est pas présent, on redirige l'utilisateur vers la page précédente
}