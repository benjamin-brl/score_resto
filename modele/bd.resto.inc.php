<?php

include "$racine/controleur/prompt.php";

class Resto extends ConnexionPDO {

    public function getRestoByIdR($idR) {
        try {
            $req = $this->cnx->prepare("SELECT * FROM resto WHERE idR=:idR");
            $req->bindValue(':idR', $idR, PDO::PARAM_INT);

            $req->execute();

            $resultat = $req->fetch();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public function getRestos() {
        try {
            $req = $this->cnx->prepare("SELECT * FROM resto");
            $req->execute();

            $resultat = $req->fetchAll();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public function getRestosByNomR($nomR) {
        try {
            if (empty($nomR)) {
                return array();
            }

            $req = $this->cnx->prepare("SELECT * FROM resto WHERE nomR LIKE :nomR");
            $req->bindValue(':nomR', "%".$nomR."%", PDO::PARAM_STR);

            $req->execute();

            $resultat = $req->fetchAll();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public function getRestosByAdresse($voieAdrR, $cpR, $villeR) {
        try {
            $req = $this->cnx->prepare("SELECT * FROM resto WHERE voieAdrR = :voieAdrR AND cpR = :cpR AND villeR = :villeR");
            $req->bindParam(':voieAdrR', $voieAdrR);
            $req->bindParam(':cpR', $cpR);
            $req->bindParam(':villeR', $villeR);
    
            $req->execute();
    
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $result;
    }

    function getRestosAimesByMailU($mailU) {
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT resto.* FROM resto,aimer WHERE resto.idR = aimer.idR AND mailU = :mailU");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    function getBestResto(){
        $resultat = array();
    
        try {
            $req = $this->cnx->prepare("SELECT r.*, avg(note) FROM resto r, critiquer c WHERE r.idR=c.idR  GROUP BY c.idR ORDER BY avg(note) DESC LIMIT 4");
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    
    function getRestoByType($type){
        $resultat = array();
    
        try {
    
            if (empty($type)) {
                return $resultat;
            }
    
            $req = $this->cnx->prepare("SELECT r.* FROM resto r, proposer p WHERE r.idR=p.idR AND p.idTC=:idTC");
            $req->bindValue(':idTC', $type, PDO::PARAM_INT);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    
    }
    
    function getRestosByMulticritere($voieAdrR, $cpR, $villeR, $types) {
        $resultat = array();
    
        try {
    
            if (empty($voieAdrR) && empty($cpR) && empty($villeR) && empty($types)) {
                return $resultat;
            }
    
            $req = "SELECT DISTINCT r.* FROM resto r, proposer p WHERE p.idR = r.idR AND r.voieAdrR LIKE :voieAdrR AND r.cpR LIKE :cpR AND r.villeR LIKE :villeR";
            
            if (!empty($types)) {
                $req .= " AND p.idTC IN (".implode(",", $types).")";
            }
    
            $req2 = $this->cnx->prepare($req);
            $req2->bindValue(':voieAdrR', "%".$voieAdrR."%", PDO::PARAM_STR);
            $req2->bindValue(':cpR', $cpR."%", PDO::PARAM_STR);
            $req2->bindValue(':villeR', "%".$villeR."%", PDO::PARAM_STR);
            $req2->execute();
    
            $resultat = $req2->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}