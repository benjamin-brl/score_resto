<?php

class ConnexionPDO {
    protected $login;
    protected $mdp;
    protected $bd;
    protected $serveur;
    protected $cnx;

    public function __construct() {
        $this->login = 'root';
        $this->mdp = '';
        $this->bd = 'bd_resto_view';
        $this->serveur = 'localhost';
        try {
            $this->cnx = new PDO("mysql:host=$this->serveur;dbname=$this->bd;charset=UTF8", $this->login, $this->mdp);
            $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Erreur de connexion PDO ";
            die();
        }
    }
}