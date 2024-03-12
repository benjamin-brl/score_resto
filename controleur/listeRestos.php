<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/controleur/prompt.php";

$mailU = $authentification->getMailULoggedOn();

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$listeRestos = $resto->getRestos();

// Meilleur resto
$meilleursResto = $resto->getBestResto();

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Liste des restaurants";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueListeRestos.php";
include "$racine/vue/pied.html.php";
