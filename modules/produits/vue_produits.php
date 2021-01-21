<?php

require_once 'modules/generique/vue_generique.php';

class VueProduit extends VueGenerique
{

	public function __construct()
	{
	}

    public function afficherProduit () {
        // to do
    }

    
    public function afficherProduits () {
        // to do
    }

    public function listeAvis($result, $estUtilisateur)
	{
		// to do
	}

    public function erreurConnexionPanier()
    {
        echo "<main>Vous devez être connecté pour pouvoir ajouter un produit au panier.</main>";
    }

}
