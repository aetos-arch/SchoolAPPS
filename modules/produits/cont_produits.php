<?php

require_once 'modules/generique/cont_generique.php';
require_once 'vue_produits.php';
require_once 'modele_produits.php';

require_once 'modules/panier/cont_panier.php';

class ContProduit extends ContGenerique
{

    public $controleurPanier;

    public function __construct()
    {
        parent::__construct(new ModeleProduit(), new VueProduit());
        $this->controleurPanier = new ContPanier();
    }

    public function listeProduits()
    {
        $data = $this->modele->getProduits();
        $this->vue->afficherProduits($data);
    }

    public function afficherProduit($nomProduit)
    {
        $idProduit = $this->modele->getIdProduit($nomProduit);
        $data = $this->modele->getProduit($idProduit['idProduit']);
        $this->vue->afficherProduit($data);
        $this->listerAvis($idProduit);
    }

    public function listerAvis($idProduit)
    {
        $data = $this->modele->getAllAvisProduit($idProduit['idProduit']);
        $this->vue->listerAvis($data, isset($_SESSION['idUtil']));
    }

    public function donnerAvis($idProduit)
    {
        $avisExiste = $this->modele->avisExiste($_SESSION['idUtil'], $idProduit);
        $this->fromDonnerAvis($idProduit, $avisExiste);
    }

    public function fromDonnerAvis($idProduit, $avisExiste)
    {
        $this->vue->formDonnerAvis($idProduit);
        $this->checkAvis($idProduit, $avisExiste);
    }

    public function checkAvis($idProduit, $avisExiste)
    {
        if (isset($_POST['commentaire'])) {
            $result = [
                'idUtilisateur' => $_SESSION['idUtil'],
                'idProduit' => addslashes(strip_tags($idProduit)),
                'titre' => addslashes(strip_tags($_POST['titre'])),
                'commentaire' => addslashes(strip_tags($_POST['commentaire'])),
                'note' => addslashes(strip_tags($_POST['note']))
            ];
            $this->verifTableauValeurNull($result);
            if ($avisExiste != 0) {
                $this->vue->messageVue("Vous avez déjà donné un avis pour ce produit");
            } else if ($this->modele->donnerAvis($result)) {
                $this->vue->messageVue("Votre avis a été pris en compte");
            } else
                $this->vue->messageVue("Votre avis n'a pas pu être ajouté");
        }
    }

    public function ajouterProduitPanier($idProduit)
    {
        if (isset($_SESSION['idUtil'])) {
            $this->controleurPanier->ajouterProduitPanier($idProduit);
        } else {
            $this->vue->erreurConnexionPanier();
        }
    }
}
