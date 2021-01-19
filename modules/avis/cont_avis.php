<?php
require_once 'modules/generique/cont_generique.php';
require_once 'vue_avis.php';
require_once 'modele_avis.php';

class ContAvis extends ContGenerique
{

    public function __construct()
    {
        parent::__construct(new modeleAvis(), new VueAvis());
    }

    public function listerAvis($nomProduit)
    {
        $idProduit = $this->modele->getIdProduit($nomProduit);
        $data = $this->modele->getAllAvisProduit($idProduit['idProduit']);
        $this->vue->listerAvis($data);
    }

    public function donnerAvis($nomProduit)
    {
        $idProduit = $this->modele->getIdProduit($nomProduit);
        $avisExiste = $this->modele->avisExiste($_SESSION['idUtilisateur'], $idProduit);
        if ($avisExiste != 0) {
           echo "avis existe déjà";
        } else if (isset($_POST['commentaire'])) {
            $result = [
                'idUtilisateur' => $_SESSION['idUtilisateur'],
                'idProduit' => addslashes(strip_tags($idProduit)),
                'titre' => addslashes(strip_tags($_POST['titre'])),
                'commentaire' => addslashes(strip_tags($_POST['commentaire'])),
                'note' => addslashes(strip_tags($_POST['note']))
            ];
            $this->modele->donnerAvis($result);
        } else {
            $this->vue->formDonnerAvis();
        }
    }


    public function supprimerAvis()
    {
        $idAvis = $_POST['idAvis'];
        $this->modele->supprimerAvis($idAvis);
        // redirection
    }

    public function modifierAvis()
    {
        if (isset($_POST['commentaire'])) {
            $result = [
                'idUtilisateur' => $_SESSION['idUtilisateur'],
                'idProduit' => strip_tags($_POST['idProduit']),
                'titre' => addslashes(strip_tags($_POST['titre'])),
                'commentaire' => addslashes(strip_tags($_POST['commentaire'])),
                'note' => addslashes(strip_tags($_POST['note']))
            ];
            $this->modele->donnerAvis($result);
        } else {
            $idAvis = $_POST['idAvis'];
            $result = $this->modele->getAvis($idAvis);
            $this->vue->formModifierAvis($result);
        }
    }
}
