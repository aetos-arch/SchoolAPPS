<?php

require_once 'config/connexion.php';

class ModeleGenerique extends Connexion {

    protected static $connexion;

    public function __construct()
    {
        self::$connexion = Connexion::initConnexion();
    }

    public function getEtats()
    {
        try {
            $req = Connexion::$bdd->prepare('select * from etats');
            $req->execute();
            return $req->fetchAll();
        } catch (PDOException $e) {
        }
    }

    public function getProduits()
    {
        try {
            $req = Connexion::$bdd->prepare('select * from produits');
            $req->execute();
            return $req->fetchAll();
        } catch (PDOException $e) {
        }
    }


}