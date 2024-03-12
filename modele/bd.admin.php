<?php

include_once "bd.inc.php";
include_once "$racine/controleur/prompt.php";

// Fonction pour supprimer le compte d'un utilisateur
function adminDeleteAccount($mailU)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("delete from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour récupérer les commentaires d'un utilisateur
function getCommentsByMailU($mailU){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from critiquer where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
