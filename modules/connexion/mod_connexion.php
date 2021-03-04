<?php
require_once "modules/generique/mod_generique.php";
require_once "cont_connexion.php";

class ModConnexion extends ModGenerique
{

    function __construct($url)
    {

        $controleurConnexion = new ContConnexion();

        $action = $url[1];

        if (isset($url[1])) {
            switch ($action) {
                case "connexion":
                    $controleurConnexion->connexion();
                    break;
                case "deconnexion":
                    $controleurConnexion->deconnexion();
                    break;
                case "inscription":
                    $controleurConnexion->inscription();
                    break;
                case "popConnexion":
                    $controleurConnexion->popConnexion();
                    break;
                case "popInscription":
                    $controleurConnexion->popInscription();
                    break;
                default:
                    $controleurConnexion->popConnexionInscription();
                    break;
            }
        }
    }
}
?>
<?php
$modConnexion = new ModConnexion((isset($url)) ? $url : null);
?>