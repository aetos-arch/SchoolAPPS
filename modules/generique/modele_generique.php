<?php

require_once 'config/connexion.php';

class ModeleGenerique extends Connexion {

    protected static $connexion;

    public function __construct()
    {
        self::$connexion = Connexion::initConnexion();
    }

}
