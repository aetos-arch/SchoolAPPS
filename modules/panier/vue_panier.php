<?php

require_once 'modules/generique/vue_generique.php';

class VuePanier extends VueGenerique
{

    function affichagePanier($listeProduit)
    {
        echo '<main><h1>Panier</h1>';
        if (empty($listeProduit)) {
            echo '<main>Votre panier est vide, remplissez-le !<br/></main>';
        } else {
            for ($i = 0; $i < count($listeProduit); $i++) {
                echo '<div class=article>
                        <div class = "nomProduit">' . ($listeProduit[$i])['nomProduit'] . '</div>
                        <div class = "prixProduit">' . ($listeProduit[$i])['prixHT'] . ' €</div>
                        <div class = "quantiteProduit">
                            <form action="/panier/moinsQte/' . ($listeProduit[$i])['idProduit'] . '"><input class = "moinsQte" type="submit" value="-"/></form>
                            <div class = "qte">' . ($listeProduit[$i])['qteProduits'] . '</div>
                            <form action="/panier/plusQte/' . ($listeProduit[$i])['idProduit'] . '"><input class = "plusQte" type="submit" value="+"/></form>
                        </div>
                <a href="/panier/suppression/' . ($listeProduit[$i])['idProduit'] . '">Supprimer</a><br><br>
                </div>';

            }
            echo '
                <div class = "totalPanier">
                    <h2>Total panier HT</h2>
                    <table>
                        <tr><th>Total</th>
                        <td class = "total">' . ($listeProduit[0])['TotalPanier'] . '</td>
                        </tr></table>
                </div></main>
                
                <div class ="validation">
                    <form action="/panier/check-out">
                        <input type="submit" value="Valider la commande">
                    </form>
                </div>';
        }
    }

        function affichageCheckOut(){
        //TODO : affichage du récap de la commande
            echo '<form action="/panier/commandeValide" method="post">
                <div class = "detailsFact">
                    <h3>Détails de la facturation</h3>
                    <input type="text" placeholder="Prénom*" name="login" required>
                    <input type="text" placeholder="Nom*" name="nom" required><br>
                    <input type="text" placeholder="Nom de l\'entreprise (facultatif)" name="entrepriseFact"><br>
                    <input type="text" placeholder="Numéro et nom de rue *" name="adresseFact" required><br>
                    <input type="text" placeholder="Code postal *" name="cpFact" required><br>
                    <input type="text" placeholder="Ville*" name="villeFact" required><br>
                    <input type="tel" placeholder="Téléphone*" name="telFact" required><br>
                    <input type="email" placeholder="Adresse de messagerie*" name="emailFact" required><br>          
                </div>
                <div class="detailsPaiement">
                    <h3>Mode de paiement</h3>
                    <h4>Carte de paiement</h4>
                    <input type="text" placeholder="Numéro de carte *" name="numCarteFact" required><br>
                    <input type="date" placeholder="Date d\'expiration *" name="dateExpfact" required><br>
                    <input type="number" placeholder="CVC *" name="cvc" required><br>
                    <input type="checkbox" required>J\'ai lu et accepté.e les <a href="/conditions-generales-de-ventes/">conditions générales</a> *
                    <button type="submit">Commander</button>
                </div>
            </form>';
    }

    function passageCommandeValide(){
        //TODO : donner licence ou produit
        echo "Votre commande est passé avec succès.";
    }

    function erreurPassageCommande(){
        //TODO : vérifier que la commande n'est vrmt pas passé
        echo "Votre commande n'est pas passé.
         L'achat a été annulé, veuillez réessayer.";
    }

}