<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";
include_once "$racine/controleur/prompt.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=profil","label"=>"Consulter mon profil");
$menuBurger[] = Array("url"=>"./?action=updProfil","label"=>"Modifier mon profil");


// recuperation des donnees GET, POST, et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
if ($authentification->isLoggedOn()){
    $mailU = $authentification->getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);    
    $mesRestosAimes = getRestosAimesByMailU($mailU);    
    $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);
    $critiques = getCritiquerByIdR(8);
    // traitement si necessaire des donnees recuperees
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $titre = "Connecté";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueMonProfil.php";
    include "$racine/vue/pied.html.php";
} else {
    $titre = "Non Connecté";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/pied.html.php";
}
