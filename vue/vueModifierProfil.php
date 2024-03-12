<h1>Modifier mon profil</h1>
<hr>
<h2>Pseudonyme</h2>
<?php
// Vérifie si une information de modification de pseudo a été passée en paramètre GET
if(isset($_GET['info'])){
    // Si le paramètre est 'modified', affiche un message de succès
    if($_GET['info'] == 'modified'){
        echo "<p style='color: green;'>Votre pseudo a bien été modifié</p>";
    }
}
// Inclusion des fichiers nécessaires
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";
?>

<p>Seulement des caractères compris entre :</p>
<ul style="display: flex; list-style-type: none;">
    <li style="padding-right: 2em;">A - Z</li>
    <li style="padding-right: 2em;">a - z</li>
    <li style="padding-right: 2em;">0 - 9</li>
</ul>
<p>Et 4 caractères minimum</p>
<!-- Formulaire de modification de pseudonyme -->
<form action="./?action=modifyUsername" method="POST">
    <input type="text" pattern="[a-zA-Z0-9]+" minlength="4" name="pseudoU" placeholder="Modifier mon pseudo"><br/>
    <input type="submit" value="Confirmer"></input>
</form>
<hr>
<h2>Mot de passe</h2>
<?php 
// Vérifie si une erreur liée au mot de passe a été passée en paramètre GET
if(isset($_GET['error'])){
    // Si le paramètre est 'password', affiche un message d'erreur
    if($_GET['error'] == 'password'){
        echo "<p style='color: red;'>Les mots de passe ne correspondent pas</p>";
    }
}
?>
<!-- Formulaire de modification de mot de passe -->
<form action="./?action=passwordModify" method="POST">
    <input type="password" pattern="[a-zA-Z0-9]+" name="passwd1" placeholder="Changer mon mot de passe"><br>
    <input type="password" pattern="[a-zA-Z0-9]+" name="passwd2" placeholder="Vérifier mon mot de passe"><br>
    <input type="submit" value="Confirmer"></input>
</form>
<hr>
<h2>Mes Restos Favoris</h2>
<?php
// Inclusion du fichier pour récupérer les photos des restaurants
include_once "$racine/modele/bd.photo.inc.php";
// Affiche chaque restaurant aimé de l'utilisateur
foreach ($mesRestosAimes as $monRestoAime) {
?>
<div class="card">
    <div class="photoCard">
        <!-- Affichage de la photo du restaurant aimé -->
        <img src="<?php echo './photos/' . getPhotosByIdR($monRestoAime['idR'])[0]['cheminP'] ?>" draggable="false" alt="">
    </div>
    <div class="descrCard">
        <!-- Affichage du nom et de l'adresse du restaurant aimé -->
        <?php echo "<a href='./?action=detail&idR=" . $monRestoAime['idR'] . "'>" . $monRestoAime['nomR'] . "</a>"; ?>
        <br />
        <?= $monRestoAime["numAdrR"] ?>
        <?= $monRestoAime["voieAdrR"] ?>
        <br />
        <?= $monRestoAime["cpR"] ?>
        <?= $monRestoAime["villeR"] ?>
        <br><br>
        <!-- Lien pour retirer le restaurant de la liste des restaurants aimés -->
        <a href="<?php echo "./?action=aimer&idR=" . $monRestoAime['idR']; ?>">Je n'aime plus</a>
    </div>
    <div class="tagCard">
        <ul id="tagFood">
        </ul>
    </div>
</div>
<?php } ?>
<!-- Si l'utilisateur n'a pas encore de restaurant aimé -->
<?php
if ($mesRestosAimes == null) {
    echo "<strong>Vous n'avez pas encore de resto favoris</strong>";
}
?>
<h2>Mes Types de Cuisines Favoris</h2>
<ul id="tagFood">
    <?php for ($i = 0; $i < count($mesTypeCuisineAimes); $i++) { ?>
        <!-- Affichage de la liste des types de cuisine aimés de l'utilisateur -->
        <li class="tag"><span class="tag">#</span><?= $mesTypeCuisineAimes[$i]["libelleTC"] ?> <a style="text-decoration: none; color:#fff" href="<?php echo "./?action=aimerType&idTC=" . $mesTypeCuisineAimes[$i]['idTC']; ?>">Retirer</a></li>
    <?php }
    if ($mesTypeCuisineAimes == null) {
        // Message affiché si l'utilisateur n'a pas encore de type de cuisine aimé
        echo "<p><strong>Vous n'avez pas encore de type de cuisine favoris</strong></p>";
    }
    ?>
<!-- Formulaire pour ajouter un nouveau type de cuisine aimé -->
<h2>Tu aimes de nouveaux types de cuisine ?</h2>
<form action="./?action=aimerType" method="POST">
    <select name="cuisine" id="cuisine">
        <?php foreach ($lesTypesCuisine as $type_cuisine) { ?>
            <option value="<?= $type_cuisine["idTC"] ?>"><?= $type_cuisine["libelleTC"] ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Confirmer">
</form>