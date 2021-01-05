<?php


require_once "cont_connexion.php";
require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ModConnexion{

    function __construct(){

        $controleur = new ContConnexion(new ModeleConnexion(), new VueConnexion());
        $action='';


        // en attendant
        $url = explode('/', $_GET['url']);
        if (isset($url[1])) {
            $action = $url[1];
            echo $url[1];
        }
        echo "Action module = " . var_dump($action);

        switch ($action) {
            case "deconnexion":
                $controleur->deconnexion();
                break;
            case "inscription":
                $controleur->popInscription();
                break;
            case "verifConnexion":
                $controleur->connexion();
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