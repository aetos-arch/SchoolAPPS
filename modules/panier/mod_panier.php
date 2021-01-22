<?php
//TODO voir pour créer un module paiement

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
                //TODO : gérer le cas d'erreur où $url[2] est nulle
                $controleurPanier->supprimerProduit($url[2]);
                break;
            case 'moinsQte' :
                //TODO : voir cas d'erreur
                $controleurPanier->moinsQte($url[2]);
                //TODO : voir pour une redirection
                break;
            case 'plusQte' :
                //TODO : voir cas d'erreur
                $controleurPanier->plusQte($url[2]);
                //TODO : voir cas d'erreur
                break;
            case 'check-out' :
                $controleurPanier->checkOut();
                break;
            case 'commandeValide' :
                //TODO : à voir pour donner le panier avant le check-out et pas au moment de payer
                //Ou alors passer le panier en commande au moment du check-out
                // mais poper que le panier a été supprimé si jamais l'utilisateur rafraichit sa page
                $controleurPanier->validationCommande();
                break;
            default :
                $controleurPanier->affichagePanier();
                break;
        }
    }

}

$modPanier = new ModPanier((isset($url)) ? $url : null);
