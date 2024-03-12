<h1>Liste des restaurants</h1>
<?php
// Pour chaque restaurant dans la liste...
for ($i = 0; $i < count($listeRestos); $i++) {
    // On récupère les types de cuisine associés à ce restaurant...
    $lesTypesCuisine = $typecuisine->getTypesCuisineByIdR($listeRestos[$i]['idR']);
    // On récupère les photos associées à ce restaurant...
    $lesPhotos = $photo->getPhotosByIdR($listeRestos[$i]['idR']);
    ?>
    <div class="card">
        <div class="photoCard">
            <?php if (count($lesPhotos) > 0) { ?>
                <!-- Si des photos sont associées, on affiche la première -->
                <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
            <?php } ?>
        </div>
        <div class="descrCard">
            <!-- On crée un lien vers la page de détails du restaurant -->
            <?php echo "<a href='./?action=detail&idR=" . $listeRestos[$i]['idR'] . "'>" . $listeRestos[$i]['nomR'] . "</a>"; ?>
            <br />
            <?= $listeRestos[$i]["numAdrR"] ?>
            <?= $listeRestos[$i]["voieAdrR"] ?>
            <br />
            <?= $listeRestos[$i]["cpR"] ?>
            <?= $listeRestos[$i]["villeR"] ?>
        </div>
        <div class="tagCard">
            <ul id="tagFood">		
                <?php for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
                    <!-- Pour chaque type de cuisine, on affiche un tag -->
                    <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php
}
// Si aucun restaurant n'a été trouvé...
if(count($listeRestos) == 0){
    echo "<p><strong>Aucun restaurant ne correspond à votre recherche</strong></p>";
}