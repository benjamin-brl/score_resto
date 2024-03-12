<?php

include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.admin.php";
include_once "$racine/controleur/prompt.php";

$isAdmin = isAdmin(getmailUloggedOn());

// Pour les administrateurs
if ($isAdmin == false) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['mailU'])) {
    $target = $_GET['mailU'];
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

adminDeleteAccount($target);
header('Location: ./?action=adminTools&info=deleted&mailU=' . $target);
