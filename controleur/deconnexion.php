<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";

$authentification->logout();

$titre = "Connexion";
header('Location: ./index.php?action=defaut&info=disconnected');