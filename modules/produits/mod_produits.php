<?php
require_once 'cont_produits.php';

class ModProduit
{
    public function __construct($url)
    {
        $controllProduit = new ContProduit();

        if (isset($url[1])) {
            $action = $url[1];
            switch ($action) {
                case 'afficher-produit':
                    if (isset($url[2])) {
                        $controllProduit->afficherProduit($url[2]);
                    } else {
                        $controllProduit->actionInexistante();
                    }
                    break;
                case 'ajouter-au-panier':
                    if (isset($url[2])) {
                        //TODO : Enlever commentaire
                        $controllProduit->afficherProduit($url[2]);
                        $controllProduit->ajouterProduitPanier($url[2]);
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