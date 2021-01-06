<?php


require_once "cont_connexion.php";
require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ModConnexion{

    function __construct(){

        $controleur = new ContConnexion(new ModeleConnexion(), new VueConnexion());
        $action='';


        //TODO : nettoyer en remontant l'explode dans un ModGenerique
        $url = explode('/', $_GET['url']);
        if (isset($url[1])) {
            $action = $url[1];
        }

        switch ($action) {
            case "deconnexion":
                $controleur->deconnexion();
                break;
            case "inscription":
                $controleur->inscription();
                break;
            case "verifConnexion":
                $controleur->verifConnexion();
                break;
            default:
                $controleur->popConnexion();
                break;
        }
    }

}
?>
<?php
    $modConnexion = new ModConnexion();
?>