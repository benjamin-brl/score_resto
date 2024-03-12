<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $titre ?></title>
    <link href="css/base.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
    <link href="css/cgu.css" rel="stylesheet">
    <link href="css/corps.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/logo.png">
</head>

<?php
if ($authentification->isLoggedOn()) {
    $mailU = $authentification->getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);
    $mesRestosAimes = getRestosAimesByMailU($mailU);
    $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);
    $admin = isAdmin($mailU);   
}

if(!isset($admin)){
    $admin = false;
}
?>

<body>
    <nav>
        <ul id="menuGeneral">
            <li><a href="./?action=accueil">Accueil</a></li>
            <li><a href="./?action=recherche"><img src="images/rechercher.png" alt="loupe" />Recherche</a></li> 
            <?php 
            // Gestion du menu admin tools
            if ($admin!=false and $admin['isAdmin'] == 1){ ?>
                <li><a href="./?action=adminTools">Administration</a></li>
            <?php } else{?>
                
                <li><a href=""></a></li>
                <?php } ?>
            <li id="logo"><a href="./?action=accueil"><img src="images/logoBarre.png" alt="logo" /></a></li>
            <li></li>
            <li><a href="./?action=cgu">CGU</a></li>
            <?php if ($authentification->isLoggedOn()) { ?>
                <li><a href="./?action=profil"><img src="images/profil.png" alt="loupe" /><?php echo $util["pseudoU"]; ?> </a></li>
            <?php } else { ?>
                <li><a href="./?action=connexion"><img src="images/profil.png" alt="loupe" />Connexion</a></li>
            <?php } ?>
        </ul>
    </nav>
    <div id="bouton">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <ul id="menuContextuel">
        <li><img src="images/logoBarre.png" alt="logo" /></li>
        <?php if (isset($menuBurger)) { ?>
            <?php for ($i = 0; $i < count($menuBurger); $i++) { ?>
                <li>
                    <a href="<?php echo $menuBurger[$i]['url']; ?>">
                        <?php echo $menuBurger[$i]['label']; ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
    <div id="corps">