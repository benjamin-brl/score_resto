<?php

include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.admin.php";
include_once "$racine/modele/bd.aimer.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/bd.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";

$controller = new ControllerPrincipal;
$authentification = new Authentification;
$resto = new Resto;
$typecuisine = new TypeCuisine;
$photo = new Photo;
$utilisateur = new Utilisateur;