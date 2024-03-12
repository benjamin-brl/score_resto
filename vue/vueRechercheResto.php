<h1>Recherche d'un restaurant</h1>
<form action="./?action=recherche&critere=<?=$critere?>" method="POST">
    <?php
    include_once("./modele/bd.typecuisine.inc.php");
    $type_cuisines = $typecuisine->getTypesCuisine();
    switch ($critere) {
        case "nom"?>
        Nom :<br/>
        <input type="text" name="nomR" placeholder="nom" value="<?= $nomR ?>"/><br/>
        <?php break?>
        
        <?php case "adresse"?>
        Adresse :<br/>
        <input type="text" name="villeR" placeholder="ville" value="<?= $villeR ?>"/><br/>
        <input type="text" name="cpR" placeholder="code postal" value="<?= $cpR ?>"/><br/>
        <input type="text" name="voieAdrR" placeholder="rue" value="<?= $voieAdrR ?>"/><br/>
        <?php break?>
        
        <?php case "cuisine"?>
        Type de cuisine :<br/>
        <select name="cuisine" id="cuisine">
            <option value=""></option>
            <?php foreach($type_cuisines as $type_cuisine){ ?>
            <option value="<?= $type_cuisine["idTC"] ?>"><?= $type_cuisine["libelleTC"] ?></option>
            <?php } ?>
        <?php break?>
        
        <?php case "multicritere"?>
        Adresse :<br/>
        <input type="text" name="villeR" placeholder="ville" value="<?= $villeR ?>"/><br/>
        <input type="text" name="cpR" placeholder="code postal" value="<?= $cpR ?>"/><br/>
        <input type="text" name="voieAdrR" placeholder="rue" value="<?= $voieAdrR ?>"/><br/>

        Type de cuisine :<br/>
            <?php foreach($type_cuisines as $type_cuisine){ ?>
            <input type="checkbox" name="type[]" value="<?= $type_cuisine["idTC"] ?>"><?= $type_cuisine["libelleTC"] ?></option>
            <?php } ?>
   <?php } ?>
    <br/>
    <input type="submit" value="Rechercher"/>
</form>