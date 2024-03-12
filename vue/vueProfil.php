<h1>Profil de <?= $target ?> </h1> <!-- titre de la page avec le pseudo de l'utilisateur cible -->
<hr>
<h2>Les Restos que <?= $target ?> aime  :</h2><br /> <!-- titre de la section des restos aimés avec le pseudo de l'utilisateur cible -->
<?php
include_once "$racine/modele/bd.photo.inc.php"; // inclusion du fichier bd.photo.inc.php
foreach ($RestosAimes as $RestoAime) { // pour chaque resto aimé par l'utilisateur cible
?>
    <div class="card"> <!-- élément de carte pour afficher les informations du resto -->
        <div class="photoCard"> <!-- élément de la carte pour afficher la photo du resto -->
            <img src="<?php echo './photos/' . getPhotosByIdR($RestoAime['idR'])[0]['cheminP'] ?>" draggable="false" alt=""> <!-- affichage de la photo du resto -->
        </div>
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $RestoAime['idR'] . "'>" . $RestoAime['nomR'] . "</a>"; ?> <!-- affichage du nom du resto et création d'un lien vers la page de détail du resto -->
            <br />
            <?= $RestoAime["numAdrR"] ?> <!-- affichage du numéro de rue du resto -->
            <?= $RestoAime["voieAdrR"] ?> <!-- affichage du nom de la rue du resto -->
            <br />
            <?= $RestoAime["cpR"] ?> <!-- affichage du code postal du resto -->
            <?= $RestoAime["villeR"] ?> <!-- affichage de la ville du resto -->
        </div>
        <div class="tagCard">
            <ul id="tagFood">
            </ul>
        </div>
    </div>
<?php } ?>
<h2>Les Types de Cuisine que  <?= $target ?> aime :</h2> <!-- titre de la section des types de cuisine aimés avec le pseudo de l'utilisateur cible -->
<ul id="tagFood">
    <?php for($i=0;$i<count($TypeCuisineAimes);$i++){ ?>
        <li class="tag"><span class="tag">#</span><?= $TypeCuisineAimes[$i]["libelleTC"] ?></li> <!-- affichage des types de cuisine aimés avec un hashtag -->
    <?php } ?>
</ul>