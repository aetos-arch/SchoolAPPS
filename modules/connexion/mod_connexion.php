<?php
require_once "modules/generique/mod_generique.php";
require_once "cont_connexion.php";
require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ModConnexion extends ModGenerique {

    function __construct($url){

        $controleur = new ContConnexion(new ModeleConnexion(), new VueConnexion());
        $action='';

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
    $modConnexion = new ModConnexion((isset($url)) ? $url : null);
?>