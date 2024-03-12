<?php

include_once "$racine/controleur/prompt.php";

class Photo extends ConnexionPDO {
    function getPhotosByIdR($idR) {
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT * FROM photo WHERE idR=:idR");
            $req->bindValue(':idR', $idR, PDO::PARAM_INT);
    
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}