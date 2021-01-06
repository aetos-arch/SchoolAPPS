<?php

require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ContConnexion {
    public $modele;
    public $vue;

    function __construct($modele, $vue){

        $this->modele = $modele;
        $this->vue = $vue;

    }

    function popConnexion(){
        $this->vue->popConnexion();
    }

    function verifConnexion(){
        $this->modele->connexion($_POST['login'],$_POST['mdp']);
        $this->vue->affichage();
    }

    function deconnexion(){
        $this->modele->deconnexion();
    }

    function inscription(){
        if($this->modele->loginExiste($_POST['login'])==0) {
            $this->modele->inscription($_POST['login'], $_POST['nom'], $_POST['prenom'],
                $_POST['mdp'], $_POST['eFacturation'], $_POST['eLivraison'], $_POST['tel'], $_POST['dateNaissance']);
            if ($this->modele->verifInscription($_SESSION['login'])==1){
                $this->vue->affichage();
            }
        }
    }

}

?>