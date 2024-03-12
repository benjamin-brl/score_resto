<!-- Titre de la page -->
<h1>Administration</h1>
<!-- Sous-titre de la page -->
<h2>Liste des utilisateurs</h2>
<?php
// Vérifier si l'utilisateur connecté est un administrateur
if (isAdmin($authentification->getMailULoggedOn()) == false) {
    header('Location: ./?action=accueil'); // Rediriger vers la page d'accueil
}

// Vérifier si les informations de suppression de compte ont été envoyées en GET
if (isset($_GET['info']) && isset($_GET['mailU'])) {
    // Si le compte a été supprimé, afficher un message de confirmation en vert
    if ($_GET['info'] == 'deleted') {
        echo "<p style='color: green;'>Le compte de " . $_GET['mailU'] . " a été supprimé</p>";
    }
}

// Obtenir la liste des utilisateurs
$users = getUtilisateurs();

// Parcourir la liste des utilisateurs et afficher leurs informations
foreach ($users as $user) { ?>
<div class="userCard">
    <div class="descrCard">
        <!-- Afficher le pseudo de l'utilisateur en gras -->
        <strong><?= $user['pseudoU'] ?></strong><br>
        <!-- Afficher l'adresse e-mail de l'utilisateur -->
        <?= $user['mailU'] ?><br>
        <br><br>
        <?php if ($user['mailU'] != $authentification->getMailULoggedOn()) { ?>
            <!-- Si l'utilisateur n'est pas l'utilisateur connecté, afficher un lien pour supprimer son compte -->
            <a href='./?action=confirm&mailU=<?= $user['mailU']; ?>'>Supprimer compte</a>
            <!-- Afficher un lien pour afficher les informations du compte de l'utilisateur -->
            <a href='./?action=infoCompte&mailU=<?= $user['mailU']; ?>'>Informations compte</a>
        <?php } else { ?>
            <!-- Si l'utilisateur est l'utilisateur connecté, afficher un message indiquant qu'il ne peut pas supprimer son propre compte -->
            <a>Vous ne pouvez pas supprimer votre compte</a>
        <?php } ?>
    </div>
</div>
<?php } ?>