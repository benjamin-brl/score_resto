<h1>Informations sur le compte</h1> <!-- Titre principal de la page -->
<strong><p style="font-size:18px;">Compte de <?= $pseudoTarget ?></p></strong> <!-- Affichage du pseudo du compte ciblé -->
<h2>Commentaires de <?= $pseudoTarget ?></h2> <!-- Titre de la section de commentaires -->
<?php
if (isAdmin($authentification->getMailULoggedOn()) == false) { // Vérification des droits d'administrateur
    header('Location: ./?action=accueil'); // Redirection vers la page d'accueil si l'utilisateur n'est pas admin
}
foreach($comments as $comment){ // Boucle pour afficher chaque commentaire
    $resto = getRestoByIdR($comment['idR']); // Récupération des informations sur le restaurant correspondant au commentaire
?>
    <h2><?=$resto['nomR']?></h2> <!-- Affichage du nom du restaurant -->
    <p><?=$comment['commentaire']?></p> <!-- Affichage du commentaire -->
    <a href="./?action=supprimerCritique&mailU=<?=$comment['mailU']?>&idR=<?=$comment['idR']?>">Supprimer</a> <!-- Lien pour supprimer le commentaire -->
<?php } 
if(count($comments) == 0 OR $comment == null){ // Vérification si l'utilisateur n'a pas laissé de commentaires
echo "<p>Cet utilisateur n'a pas encore laissé de commentaire</p>"; // Affichage d'un message si l'utilisateur n'a pas de commentaires
}