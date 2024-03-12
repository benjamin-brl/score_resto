<?php

// inclusion du fichier bd.typecuisine.inc.php
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/controleur/prompt.php";

// récupération de l'id de type de cuisine depuis l'URL
if(isset($_GET['idTC'])){
    $idTC = $_GET['idTC'];
}

// récupération de l'id de type de cuisine depuis le formulaire
if(isset($_POST['cuisine'])){
    $idTC = $_POST['cuisine'];
}

// récupération des types de cuisine aimés par un utilisateur
$aimer = getTClikeByID("test@bts.sio", "1");
echo $aimer;

$mailU = $authentification->getMailULoggedOn();
if ($mailU != "") {

    // vérification si l'utilisateur aime déjà le type de cuisine
    $aimer = getTClikeByID($mailU, $idTC);
    
    // si l'utilisateur n'aime pas encore le type de cuisine, on l'ajoute dans la base de données
    if ($aimer == false) {
        likeTypeCuisine($mailU, $idTC);
    } else {
        // sinon, on supprime l'entrée correspondante dans la base de données
        unlikeTypeCuisine($mailU, $idTC);
    }
}

// redirection vers la page précédente
header('Location: ' . $_SERVER['HTTP_REFERER']);