<?php

include_once "$racine/controleur/prompt.php";

class Utilisateur extends ConnexionPDO {

    function getUtilisateurs() {
    $resultat = array();
        try {
            $req = $this->cnx->prepare("SELECT * FROM utilisateur");
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    function getUtilisateurByPseudo($pseudoU) {
    $resultat = array();
        try {
            $req = $this->cnx->prepare("SELECT * FROM utilisateur WHERE pseudoU=:pseudoU");
            $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);
            $req->execute();
            
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    function modifyUsername($mailU,$pseudoU){
        try {
            $req = $this->cnx->prepare("UPDATE utilisateur SET pseudoU=:pseudoU WHERE mailU=:mailU");
            $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    function modifyPassword($mailU,$passwd){
        try {
            $req = $this->cnx->prepare("UPDATE utilisateur SET mdpU=:mdpU WHERE mailU=:mailU");
            $req->bindValue(':mdpU', $passwd, PDO::PARAM_STR);
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    function getUtilisateurByMailU($mailU) {
    $resultat = array();
        try {
            $req = $this->cnx->prepare("SELECT * FROM utilisateur WHERE mailU=:mailU");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
            
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    function addUtilisateur($mailU, $mdpU, $pseudoU) {
        try {
            $cnx = connexionPDO();
    
            $mdpUCrypt = crypt($mdpU, "sel");
            $req = $cnx->prepare("INSERT INTO utilisateur (mailU, mdpU, pseudoU) VALUES(:mailU,:mdpU,:pseudoU)");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->bindValue(':mdpU', $mdpUCrypt, PDO::PARAM_STR);
            $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);
            
            $resultat = $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    
    }
    
    function isAdmin($mailU){
        $resultat = array();
        try {
            $req = $this->cnx->prepare("SELECT isAdmin FROM ADMIN WHERE user_mail=:mailU");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
    
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}