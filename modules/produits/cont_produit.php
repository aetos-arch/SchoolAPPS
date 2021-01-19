<?php

require_once 'modules/generique/cont_generique.php';
require_once 'vue_produit.php';
require_once 'modele_produit.php';

class ContProduit extends ContGenerique
{

	public function __construct()
	{
		parent::__construct(new ModeleProduit(), new VueProduit());
    }
    
    public function listeProduits () {
      $data = $this->modele->getAllProduit();
      $this->vue->afficherProduits($data);
    }

    public function afficherProduit ($nomProduit) {
      $idProduit = $this->modele->getIdProduit($nomProduit);
      $data = $this->modele->getProduit($idProduit['idProduit']);
      $this->vue->afficherProduit($data);

      $this->listerAvis($idProduit);
    }

    public function listerAvis($idProduit)
    {
        $data = $this->modele->getAllAvisProduit($idProduit['idProduit']);
        $this->vue->listerAvis($data);
    }
}