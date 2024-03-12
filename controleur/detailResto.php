<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/controleur/prompt.php";

// Configuration du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"#top","label"=>"Le restaurant");
$menuBurger[] = Array("url"=>"#adresse","label"=>"Adresse");
$menuBurger[] = Array("url"=>"#photos","label"=>"Photos");
$menuBurger[] = Array("url"=>"#horaires","label"=>"Horaires");
$menuBurger[] = Array("url"=>"#crit","label"=>"Critiques");

// Récupération de l'identifiant du restaurant depuis les paramètres GET
$idR = $_GET["idR"];

// Récupération des informations sur le restaurant correspondant à l'identifiant
$unResto = getRestoByIdR($idR);

// Récupération des types de cuisine proposés par le restaurant
$lesTypesCuisine = getTypesCuisineByIdR($idR);

// Récupération des photos associées au restaurant
$lesPhotos = getPhotosByIdR($idR);

// Calcul de la note moyenne attribuée au restaurant
if(getNoteMoyenneByIdR($idR) != null){
    $noteMoy = round(getNoteMoyenneByIdR($idR), 0);
} else{
    $noteMoy = 0;
}

// Définition du titre de la page
$titreRestau = $unResto['nomR'];
$titre = $titreRestau;

// Récupération de l'adresse email de l'utilisateur connecté et de son statut "aimer" pour le restaurant courant
$mailU = $authentification->getMailULoggedOn();
$aimer = getAimerById($mailU, $idR);

// Récupération des critiques associées au restaurant courant
$critiques = getCritiquerByIdR($idR);

// Récupération de la critique de l'utilisateur courant pour le restaurant courant (s'il y en a une)
$maCritique = getCritiquerBySelf($idR, $mailU);

// Définition du commentaire de l'utilisateur courant s'il a déjà fait une critique
$monCommentaire = "";
if($maCritique){
    $monCommentaire = $maCritique;
}

include "$racine/vue/entete.html.php";
include "$racine/vue/vueDetailResto.php";
include "$racine/vue/pied.html.php";