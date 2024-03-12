<?php

include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";
include_once "$racine/controleur/prompt.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=profil","label"=>"Consulter mon profil");
$menuBurger[] = Array("url"=>"./?action=updProfil","label"=>"Modifier mon profil");


if ($authentification->isLoggedOn()) {
    $mailU = $authentification->getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);
    $mesRestosAimes = getRestosAimesByMailU($mailU);
    $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);   
}

$lesTypesCuisine = getTypesCuisine();

$titre = "Modifier mon profil";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueModifierProfil.php";
include "$racine/vue/pied.html.php";