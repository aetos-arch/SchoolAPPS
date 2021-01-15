<?php

require_once 'modules/generique/cont_generique.php';
require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ContConnexion extends ContGenerique {

    function __construct($modele, $vue){
        parent::__construct($modele, $vue);
    }

    function popConnexion(){
        $this->vue->popConnexion();
    }

    function verifConnexion(){
        $this->modele->connexion($_POST['login'], $_POST['mdp']);
        $this->vue->affichage();
    }

    function deconnexion(){
        $this->modele->deconnexion();
        echo '<main>Vous avez bien été déconnecté(e).<br>
            <a href="/home">Retour à la page d\'accueil</a></main>';
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