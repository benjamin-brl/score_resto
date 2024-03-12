<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
include_once("$racine/modele/bd.admin.php");

// Si aucun pseudo d'utilisateur n'est spécifié en paramètre GET, on redirige vers la page d'accueil
if(!isset($_GET['pseudoU'])){
    header("Location: ./?action=defaut");
} else {
    $target = $_GET['pseudoU'];
}

// Récupération de l'utilisateur cible et de ses commentaires
$user = getUtilisateurByPseudo($target);
$target_commentaires = getCommentsByMailU($user['mailU']);

// Si l'utilisateur cible n'existe pas, on affiche une vue spécifique
if($user == false){
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueInconnu.php";
    include "$racine/vue/pied.html.php";
} else {
    $name = $user['pseudoU'];
    $titre = "Profil de $name";
    $RestosAimes = getRestosAimesByMailU($user['mailU']);
    $TypeCuisineAimes = getTypesCuisinePreferesByMailU($user['mailU']);
    
    // Affichage de la vue de profil avec les informations récupérées
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueProfil.php";
    include "$racine/vue/pied.html.php";
}