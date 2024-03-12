<h1>Mon profil</h1>
<!-- Affichage du mail de l'utilisateur -->
Mon mail : <?= $util["mailU"] ?> <br />
<!-- Affichage du pseudo de l'utilisateur -->
Mon pseudo : <?= $util["pseudoU"] ?> <br />
<hr>
<h2>Mes Restos Favoris</h2> <br />
<?php
// Inclusion du fichier d'accès à la BD pour les photos
include_once "$racine/modele/bd.photo.inc.php";
// Boucle pour afficher les restaurants favoris de l'utilisateur
foreach ($mesRestosAimes as $monRestoAime) {
?>
    <!-- Affichage d'une carte pour chaque restaurant favori -->
    <div class="card">
        <!-- Affichage de la photo du restaurant -->
        <div class="photoCard">
            <img src="<?php echo './photos/' . getPhotosByIdR($monRestoAime['idR'])[0]['cheminP'] ?>" draggable="false" alt="">
        </div>
        <!-- Affichage du nom et de l'adresse du restaurant -->
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $monRestoAime['idR'] . "'>" . $monRestoAime['nomR'] . "</a>"; ?>
            <br />
            <?= $monRestoAime["numAdrR"] ?>
            <?= $monRestoAime["voieAdrR"] ?>
            <br />
            <?= $monRestoAime["cpR"] ?>
            <?= $monRestoAime["villeR"] ?>
        </div>
        <!-- Affichage des tags associés au restaurant -->
        <div class="tagCard">
            <ul id="tagFood">
            </ul>
        </div>
    </div>
<?php } ?>
<!-- Affichage des types de cuisine favoris de l'utilisateur -->
<h2>Mes Types de Cuisines Favoris</h2>
<ul id="tagFood">		
<?php for($i=0;$i<count($mesTypeCuisineAimes);$i++){ ?>
    <!-- Affichage d'un tag pour chaque type de cuisine favori -->
    <li class="tag"><span class="tag">#</span><?= $mesTypeCuisineAimes[$i]["libelleTC"] ?></li>
<?php } ?>
</ul>
<br>
<!-- Bouton de déconnexion de l'utilisateur -->
<a href="./?action=deconnexion">Deconnexion</a>