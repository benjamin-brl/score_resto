<h1><?= $unResto['nomR']; ?>
    <!-- Si l'utilisateur a aimé ce restaurant, afficher l'icône "j'aime". Sinon, afficher l'icône "je n'aime pas encore". -->
    <?php if ($aimer != false) { ?>
        <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aime.png" alt="j'aime ce restaurant"></a>
    <?php } else { ?>
        <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aimepas.png" alt="je n'aime pas encore ce restaurant"></a>
    <?php } ?>
</h1>

<!-- Afficher la note moyenne du restaurant en utilisant des étoiles. -->
<span id="note">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <a class="aimer" href="./?action=noter&note=<?= $i ?>&idR=<?= $unResto['idR']; ?>">
            <?php if ($i <= $noteMoy) { ?>
                <img class="note" src="images/like.png" alt="">
            <?php } else {
            ?>
                <img class="note" src="images/neutre.png" alt="line neutre">
            <?php } ?>
        </a>
    <?php } ?>
</span>

<section>
    Cuisine <br />
    <!-- Afficher les types de cuisine offerts par le restaurant en utilisant des hashtags. -->
    <ul id="tagFood">
        <?php for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
            <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
        <?php } ?>
    </ul>
</section>

<p id="principal">
    <!-- Afficher la première photo du restaurant, s'il y en a. -->
    <?php if (count($lesPhotos) > 0) { ?>
        <img draggable="false" src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
    <br />
    <?= $unResto['descR']; ?>
</p>

<h2 id="adresse">
    Adresse
</h2>
<!-- Afficher l'adresse complète du restaurant. -->
<p>
    <?= $unResto['numAdrR']; ?>
    <?= $unResto['voieAdrR']; ?><br />
    <?= $unResto['cpR']; ?>
    <?= $unResto['villeR']; ?>
</p>

<h2 id="photos">
    Photos
</h2>
<!-- Afficher les photos du restaurant. -->
<ul id="galerie">
    <?php for ($i = 0; $i < count($lesPhotos); $i++) { ?>
        <li> <img draggable="false" class="galerie" src="photos/<?= $lesPhotos[$i]["cheminP"] ?>" alt="" /></li>
    <?php } ?>
</ul>

<!-- Affichage de la section Horaires -->

<h2 id="horaires">
    Horaires
</h2>
<?= $unResto['horairesR']; ?> <!-- affichage des horaires du restaurant -->
<!-- Affichage de la section Critiques -->

<h2 id="crit">Critiques</h2>
<div class="writeCritique">
    <!-- Vérification si l'utilisateur est connecté et s'il a déjà rédigé une critique -->
    <?php if($authentification->isLoggedOn()){
        if($monCommentaire != null){ ?>
            <!-- Formulaire de modification de la critique existante -->
            <h3>Modifier votre critique</h3>
            <form  method="POST" action="./?action=modifierCritique&idR=<?= $unResto['idR']; ?>">
                <textarea name="critique" id="critique" cols="60" rows="5"><?= $monCommentaire['commentaire'] ?></textarea>
                <button type="submit">Mettre à jour</button>
            </form>
        <?php } else { ?>
            <!-- Formulaire de rédaction d'une nouvelle critique -->
            <h3>Rédiger une critique</h3>
            <form  method="POST" action="./?action=addCritique&idR=<?= $unResto['idR']; ?>">
                <textarea name="critique" id="critique" cols="60" rows="5"></textarea>
                <button type="submit">Envoyer</button>
            </form>
        <?php }} ?>
</div>
<?php $isAdmin = isAdmin($mailU); ?> <!-- Vérification si l'utilisateur est un administrateur -->
<ul id="critiques">
    <?php for ($i = 0; $i < count($critiques); $i++) {
        $selectedUser = getUtilisateurByMailU($critiques[$i]['mailU'])?>
        <li>
            <span>
                <a href="?action=voirProfil&pseudoU=<?=$selectedUser['pseudoU']?>"><?=$selectedUser['pseudoU']?></a> <!-- affichage du pseudo de l'utilisateur qui a rédigé la critique -->
                <?php if ($critiques[$i]["mailU"] == $mailU OR $isAdmin !=false ) { ?>
                    <a href='./?action=supprimerCritique&idR=<?= $unResto['idR']; ?>&mailU=<?= $critiques[$i]['mailU']; ?>'>Supprimer</a> <!--lien pour supprimer la critique -->
                <?php } ?>
            </span>
            <div>
                <span>
                    <?php // affichage de la note donnée par l'utilisateur
                    if ($critiques[$i]["note"]) {
                        echo $critiques[$i]["note"] . "/5"; 
                    }
                    ?>
                </span>
                <span><?= $critiques[$i]["commentaire"] ?> </span> <!-- affichage du commentaire rédigé par l'utilisateur -->
            </div>
            </li>
<?php } // affichage d'un message si le restaurant n'a pas encore de critique
if(count($critiques) == 0){
    echo "<p><strong>Ce restaurant n'a pas encore de critique</strong></p>";
}