<?php

require_once "modules/generique/mod_generique.php";
require_once 'cont_panier.php';

class ModPanier extends ModGenerique {

    function __construct($url){

        $controleur = new ContPanier();

        if (isset($url[1])) {
            $action = $url[1];
        }else{
            $action = '';
        }

        switch ($action) {
            case 'suppression' :
                //TODO : gérer le cas d'erreur où $url[2] est nulle
                $controleur->supprimerProduit($url[2]);
            default:
                $controleur->affichagePanier();
                break;
        }
    }

}

$modPanier = new ModPanier((isset($url)) ? $url : null);

?>
