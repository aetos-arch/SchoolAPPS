<?php
require_once "modules/generique/mod_generique.php";
require_once 'cont_panier.php';

class ModPanier extends ModGenerique {

    function __construct($url){

        $controleurPanier = new ContPanier();

        $action = '';
        if (isset($url[1])) {
            $action = $url[1];
        }

        switch ($action) {
            case 'suppression' :
                $controleurPanier->supprimerProduit($url[2]);
                break;
            case 'moinsQte' :
                $controleurPanier->moinsQte($url[2]);
                break;
            case 'plusQte' :
                $controleurPanier->plusQte($url[2]);
                break;
            case 'check-out' :
                $controleurPanier->checkOut();
                break;
            case 'commandeValide' :
                $controleurPanier->validationCommande();
                break;
            default :
                $controleurPanier->affichagePanier();
                break;
        }
    }
}

$modPanier = new ModPanier((isset($url)) ? $url : null);
