<?php
// Vérifie si l'utilisateur connecté est un administrateur, sinon redirige vers la page d'accueil
if (isAdmin($authentification->getMailULoggedOn()) == false) {
    header('Location: ./?action=accueil');
}

// Si un mail d'utilisateur est présent dans la requête, récupère les informations de l'utilisateur correspondant
if (isset($_GET['mailU'])) {
    $target = getUtilisateurByMailU($_GET['mailU']);
}
?>

<!-- Affichage de la page -->
<h1>Confirmer la suppression</h1>
<p style="font-size: 18px;">
    Supprimer le compte de <strong> <?= $target['pseudoU'] ?> (<?= $target['mailU'] ?>) </strong> ?
</p>
<a style="font-size: 18px; text-decoration:none;" href="./?action=adminDeleteAccount&mailU=<?= $target['mailU'] ?>">
    Oui
</a>
<a style="font-size: 18px; text-decoration:none;" href="./?action=adminTools">
    Non
</a>