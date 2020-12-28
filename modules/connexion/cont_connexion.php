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

    function connexion(){
        $this->modele->connexion($_POST['id'],$mdp=$_POST['mdp']);
        //header("Location: index.php");
    }

    function deconnexion(){
        $this->modele->deconnexion();
        //header("Location: index.php");
    }

    function popInscription(){
        $this->vue->popInscription();
    }

    function inscription(){
        $this->modele->inscription($_POST['id']);
    }

}

?>