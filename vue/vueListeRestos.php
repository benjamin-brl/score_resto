<?php
// Vérification si des informations ont été passées en GET
if (isset($_GET['info'])) {
    // Si le mot de passe a été modifié, afficher un message de confirmation
    if ($_GET['info'] == 'modified') {
        echo "<p style='color: green; text-align: center;'>Mot de passe modifié.</p>";
        echo "<p style='text-align: center;'>Vous avez été déconnecté automatiquement.</p>";
    }
    // Si l'utilisateur a été déconnecté, afficher un message de confirmation
    if ($_GET['info'] == 'disconnected') {
        echo "<p style='color: white; text-align: center;'>Au revoir!</p>";
        echo "<p style='color: green; text-align: center;'>Vous avez été déconnecté.</p>";
    }
}
?>
<div id="header" class="welcome">
    <p>
        <write-and-delete timeout="1000" loop="true" speed="100">
            Bienvenue., A la recherche d'un bon resto ?, Un petit cafée ?, r3st0.fr
        </write-and-delete>
    </p>
</div>
<h1>Le Top 4</h1>
<?php
// Boucle à travers les 4 meilleurs restaurants
foreach ($meilleursResto as $meilleurResto) {
    // Récupération des types de cuisine et des photos pour chaque restaurant
    $lesTypesCuisine = $typecuisine->getTypesCuisineByIdR($meilleurResto['idR']);
    $lesPhotos = $photo->getPhotosByIdR($meilleurResto['idR']);
?>
    <div class="card">
        <div class="photoCard">
            <?php
            // Affichage de la première photo si elle existe
            if (count($lesPhotos) > 0) { ?>
                <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>"/>
            <?php } ?>
        </div>
        <div class="descrCard"><?php
            // Affichage du nom du restaurant avec un lien vers la page des détails
            echo "<a href='./?action=detail&idR=" . $meilleurResto['idR'] . "'>" . $meilleurResto['nomR'] . "</a>"; ?>
            <br />
            <?= $meilleurResto["numAdrR"] ?>
            <?= $meilleurResto["voieAdrR"] ?>
            <br />
            <?= $meilleurResto["cpR"] ?>
            <?= $meilleurResto["villeR"] ?>
            <br><br>
            <strong><?= round($meilleurResto['avg(note)']) . "/5" ?></strong>
        </div>
        <div class="tagCard">
            <ul id="tagFood">
                <?php
                // Boucle à travers les types de cuisine pour chaque restaurant
                for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
                    <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>

<h1>Liste des Restos</h1>

<?php
// Parcours de la liste des restaurants
for ($i = 0; $i < count($listeRestos); $i++) {

    // Récupération des photos et types de cuisine pour le restaurant courant
    $lesPhotos = $photo->getPhotosByIdR($listeRestos[$i]['idR']);
    $lesTypesCuisine = $typecuisine->getTypesCuisineByIdR($listeRestos[$i]['idR']);
?><div class="card">
<div class="photoCard">
    <?php if (count($lesPhotos) > 0) { ?>
        <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
</div>
<div class="descrCard">
    <?php
    // Affichage du nom du restaurant avec un lien vers sa page détail
    echo "<a href='./?action=detail&idR=" . $listeRestos[$i]['idR'] . "'>" . $listeRestos[$i]['nomR'] . "</a>"; 
    ?>
    <br />
    <?= $listeRestos[$i]["numAdrR"] ?>
    <?= $listeRestos[$i]["voieAdrR"] ?>
    <br />
    <?= $listeRestos[$i]["cpR"] ?>
    <?= $listeRestos[$i]["villeR"] ?>
</div>
<div class="tagCard">
    <ul id="tagFood">
        <?php 
        // Parcours de la liste des types de cuisine pour affichage des tags correspondants
        for ($j = 0; $j < count($lesTypesCuisine); $j++) { 
        ?>
            <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
        <?php } ?>
    </ul>
</div>
</div>
<?php
} // Fin de la boucle de parcours de la liste des restaurants