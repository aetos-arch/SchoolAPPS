<?php

require_once 'modules/generique/cont_generique.php';
require_once 'modele_panier.php';
require_once 'vue_panier.php';

class ContPanier extends ContGenerique {

    function __construct(){
        parent::__construct(new ModelePanier, new VuePanier);
    }

    function affichagePanier(){
        if (!isset($_SESSION['idUtil'])){
            $this->vue->affichageDMDUtilCo();
        }else{
            if (!isset($_SESSION['panier'])){
                $this->modele->creationPanier($_SESSION['idUtil']);
            }
            $this->vue->affichagePanier($this->modele->recuperationPanier($_SESSION['idUtil'], $_SESSION['panier']));
        }
    }

    function supprimerProduit($idProduit){
        if ($this->modele->supprimerProduit($idProduit)==true) {
            //TODO : voir pour une redirection vers panier
            // + voir ce qu'on peut faire pour un retour arrière pour éviter de remettre dans le panier
            $this->vue->affichageProduitSup();
        }else{
            $this->vue->affichageSupProduitErreur();
        }
    }

    function ajouterProduitPanier($idProduit){
        if (!isset($_SESSION['panier'])){
            $this->modele->creationPanier($_SESSION['idUtil']);
        }
        $this->modele->ajouterProduitPanier($idProduit, $this->modele->getIDPanier($_SESSION['idUtil']));
    }

    //Fonctions pour les vues
    static function avoirNBProduitsPanier(){
        if (!isset($_SESSION['panier'])){
            return 0;
        }
        return ModelePanier::avoirNBProduitsPanier($_SESSION['panier']);
    }

    function moinsQte($idProduit){
        $this->modele->moinsQte($idProduit,$_SESSION['panier']);
    }

    function plusQte($idProduit){
        $this->modele->plusQte($idProduit,$_SESSION['panier']);
        header('Location: /panier/');
    }

    function checkOut(){
        $this->vue->affichageCheckOut();
    }

    function validationCommande(){
        //TODO : mieux gérer si erreur dans la commande survient
        $this->modele->passagePanierCommande($_SESSION['panier'], $_SESSION['idUtil']);
        $this->vue->passageCommandeValide();
    }

}
