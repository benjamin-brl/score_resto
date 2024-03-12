<?php 

include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.admin.php";
include_once "$racine/controleur/prompt.php";

// Vérification des droits d'administrateur
$isAdmin = isAdmin($authentification->getMailULoggedOn());
if ($isAdmin == false) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// Récupération de l'utilisateur ciblé
if(isset($_GET['mailU'])){
    $target = $_GET['mailU'];
    $user = getUtilisateurByMailU($target);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// Récupération des informations de l'utilisateur ciblé
$pseudoTarget = $user['pseudoU'];
$mailTarget = $user['mailU'];

// Récupération des commentaires laissés par l'utilisateur ciblé
$comments = getCommentsByMailU($target);

// Inclusion des vues
require_once('./vue/entete.html.php');
require_once('./vue/vueInfo.php');
require_once('./vue/pied.html.php');
