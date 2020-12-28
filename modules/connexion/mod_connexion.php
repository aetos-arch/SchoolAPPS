<?php

include_once "cont_connexion.php";
include_once "modele_connexion.php";
include_once "vue_connexion.php";

//TODO :
//HASHER MDP

class ModConnexion{

    private $controleur;

    function __construct(){

        $this->controleur = new ContConnexion(new ModeleConnexion(), new VueConnexion());

        $action='';
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }
        switch ($action) {
            case "popConnexion":
                $this->controleur->popConnexion();
                break;
            case "connexion":
                $this->controleur->connexion();
                break;
            case "deconnexion":
                $this->controleur->deconnexion();
                break;
            case "inscription":
                $this->controleur->popInscription();
                break;
            case "inscription":
                $this->controleur->inscription();
            default:
                break;
        }
    }

    function affichage(){
        if (isset($_SESSION['login'])){
            echo "Vous etes connecté en tant que ".$_SESSION['login']."<br>";
        }
        if (isset($_SESSION['login'])) {
            echo "<a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a><t>";
        }else{
            echo "<a href=\"index.php?module=connexion&action=formConnexion\">Se connecter</a><t>
			<a href=\"index.php?module=connexion&action=inscription\">S'inscrire</a><t>";
        }
    }

}

?>