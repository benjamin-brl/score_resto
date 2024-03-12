<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/controleur/prompt.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=recherche&critere=nom","label"=>"Recherche par nom");
$menuBurger[] = Array("url"=>"./?action=recherche&critere=adresse","label"=>"Recherche par adresse");
$menuBurger[] = Array("url"=>"./?action=recherche&critere=cuisine","label"=>"Recherche par type de cuisine");
$menuBurger[] = Array("url"=>"./?action=recherche&critere=multicritere","label"=>"Recherche multicritères");

// critere de recherche par defaut
$critere = "nom";
if (isset($_GET["critere"])) {
    $critere = $_GET["critere"];
}

// recuperation des donnees GET, POST, et SESSION
if (isset($_GET["critere"])){
    $critere = $_GET["critere"];
}

if (isset($_POST["cuisine"])){
    $type = $_POST["cuisine"];
} else {
    $type = 0;
}

$nomR="";

if (isset($_POST["nomR"])){
    $nomR = $_POST["nomR"];
}
$voieAdrR="";
if (isset($_POST["voieAdrR"])){
    $voieAdrR = $_POST["voieAdrR"];
}
$cpR="";
if (isset($_POST["cpR"])){
    $cpR = $_POST["cpR"];
}
$villeR="";
if (isset($_POST["villeR"])){
    $villeR = $_POST["villeR"];
}
$tabIdTC = array();
if(isset($_POST["tabIdTC"])){
    $tabIdTC = $_POST["tabIdTC"];
}


$types = array();
if(isset($_POST["type"])){
    $types = $_POST["type"];
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

switch($critere){
    case 'nom':
        // recherche par nom
        $listeRestos = $resto->getRestosByNomR($nomR);
        break;
    case 'adresse':
        // recherche par adresse
        $listeRestos = $resto->getRestosByAdresse($voieAdrR, $cpR, $villeR);
        break;

    case 'cuisine':
        // recherche par type de cuisine
        if (!empty($tabIdTC)) {
            $listeRestos = $resto->getRestosByTypeAndTC($type, $tabIdTC);
        } else {
            $listeRestos = $resto->getRestoByType($type);
        }
        break;

    // recherche multicritere
    case 'multicritere':
        $listeRestos = $resto->getRestosByMulticritere($voieAdrR, $cpR, $villeR, $types);
}

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Rechercher un restaurant";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueRechercheResto.php";
if (!empty($_POST)) {
    // affichage des resultats de la recherche
    include "$racine/vue/vueResultRecherche.php";
}
include "$racine/vue/pied.html.php";