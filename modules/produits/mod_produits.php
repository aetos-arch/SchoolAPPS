<?php
require_once 'cont_produits.php';

class ModProduit extends ModeleGenerique
{
    public function __construct($url)
    {
        $controllProduit = new ContProduit();

        if (isset($url[1])) {
            $action = $url[1];
            switch ($action) {
                case 'afficher-produit':
                    if (isset($url[2])) {
                        $controllProduit->afficherProduit(addslashes(strip_tags($url[2])));
                    } else {
                        $controllProduit->actionInexistante();
                    }
                    break;
                case 'ajouter-au-panier':
                    if (isset($url[2])) {
                        //TODO : Corriger afficherProduit
                        //$controllProduit->afficherProduit($url[2]);
                        $controllProduit->ajouterProduitPanier($url[2]);
                    } else {
                        $controllProduit->actionInexistante();
                    }
                    break;
                case 'ajouter-avis':
                    if (isset($url[2]) && is_numeric($url[2])) {
                        $idProduit = addslashes(strip_tags($url[2]));
                        $controllProduit->donnerAvis($url[2]);
                    } else {
                        $controllProduit->actionInexistante();
                    }
                    break;
                default:
                    $controllProduit->actionInexistante();
                    break;
            }
        } else
            $controllProduit->listeProduits();
    }
}

?>

<?php
$modproduit = new ModProduit((isset($url)) ? $url : null);
?>