<?php

include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.admin.php";
include_once "$racine/controleur/prompt.php";

// Les vues

require_once('./vue/entete.html.php');
require_once('./vue/vueConfirm.php');
require_once('./vue/pied.html.php');

$isAdmin = isAdmin($mailU);

if ($isAdmin == false) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
