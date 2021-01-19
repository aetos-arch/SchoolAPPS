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
            echo '<main>Vous devez être connecté pour avoir un panier !</main>';
            //TODO : voir si on créé quand même un panier même si l'utilisateur n'est pas connecté
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
            echo "<main>Le produit a été supprimé.</main>";
        }else{
            echo "<main>Il y a eu une erreur, le produit n'a pas été supprimé, veuillez recommencer.</main>";
        }
    }

}

?>