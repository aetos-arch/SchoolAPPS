<?php

require_once "modules/generique/mod_generique.php";

class ModPanier extends ModGenerique {

    function __construct($url){

        $controleur = new ContPanier();

        if (isset($url[1])) {
            $action = $url[1];
        }

        switch ($action) {
            default:
                $controleur->affichagePanier();
                break;
        }
    }

}

$modPanier = new ModPanier();
