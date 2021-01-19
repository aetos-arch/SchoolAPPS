<?php

require_once 'modules/generique/vue_generique.php';

class VuePanier extends VueGenerique
{

    function affichagePanier($listeProduit){
        echo '<main><h1>Panier</h1>';
        if (empty($listeProduit)){
            echo '<main>Votre panier est vide, remplissez-le !<br/></main>';
        }else{
            for ($i=0; $i < count($listeProduit); $i++) {
                echo '<b>'.($listeProduit[$i])['nomProduit'].'</b><br>'.
                    ($listeProduit[$i])['prixHT'].' €<br>'.
                    ($listeProduit[$i])['qteProduits'].'<br>
                <a href="/panier/suppression/'.($listeProduit[$i])['idProduit'].'">Supprimer</a><br><br>';
            }
            echo '<br>
              <h3>Total HT : '.($listeProduit[0])['TotalPanier'].'</h3></main>';
        }
    }
}