<?php

include_once("modele/bd.critiquer.inc.php");
include_once("modele/authentification.inc.php");
include_once "$racine/controleur/prompt.php";

if(isset($_POST["critique"])){
    
    // Récupération de l'identifiant du restaurant, de l'adresse email de l'utilisateur connecté et de sa critique
    $idR = $_GET["idR"];
    $mailU = $authentification->getMailULoggedOn();
    $critique = $_POST["critique"];
    
    // Appel de la fonction pour mettre à jour la critique de l'utilisateur
    $resultat = updateCritique($idR,$mailU,$critique);
    
    // Vérification du résultat et redirection vers la page précédente avec un message approprié
    if($resultat == 1){
        $message = "Votre critique a été ajoutée";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    else{
        $message = "Une erreur est survenue";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
}
else{
    $message = "Une erreur est survenue";
}