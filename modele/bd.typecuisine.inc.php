<?php

include "$racine/controleur/prompt.php";

class typecuisine extends ConnexionPDO {
    function getTypesCuisine() {
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT * FROM typecuisine");
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getTypesCuisinePreferesByMailU($mailU) {
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT typecuisine.* FROM typecuisine,preferer WHERE typecuisine.idTC = preferer.idTC AND preferer.mailU = :mailU");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getTypesCuisineNonPreferesByMailU($mailU) {
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT * FROM typecuisine WHERE idTC NOT IN (SELECT typecuisine.idTC FROM typecuisine,preferer WHERE typecuisine.idTC = preferer.idTC AND preferer.mailU = :mailU)");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
    
            $ligne = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getTypesCuisineByIdR($idR){
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT typecuisine.* FROM typecuisine,proposer WHERE typecuisine.idTC = proposer.idTC AND proposer.idR = :idR");
            $req->bindValue(':idR', $idR, PDO::PARAM_INT);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getTClikeByID($mailU, $idTC){
        try {
            $req = $this->cnx->prepare("SELECT * FROM preferer WHERE mailU=:mailU AND idTC=:idTC");
            $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function liketypecuisine($mailU,$idTC){
        $resultat = -1;
        try {
            $req = $this->cnx->prepare("INSERT INTO preferer (mailU, idTC) VALUES(:mailU,:idTC)");
            $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            
            $resultat = $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function unliketypecuisine($mailU,$idTC){
        $resultat = -1;
        try {
            $req = $this->cnx->prepare("DELETE FROM preferer WHERE idTC=:idTC AND mailU=:mailU");
            $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            
            $resultat = $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}