<?php

require_once 'modules/generique/vue_generique.php';

class VuePanier extends VueGenerique
{

    function affichagePanier($listeProduit)
    {
        echo '<section><br><h1>Panier</h1><hr>';
        if (empty($listeProduit)) {
            //TODO : Mise en page du message
            echo '<span class="info-utilisateur">Votre panier est vide, remplissez-le !<br/></span></section>';
        } else {
            for ($i = 0; $i < count($listeProduit); $i++) {
                echo '
                    <section class="row"><aside class="col-lg-12 p-1 m-2">
                    <div class=card>
                        <div class = "header">' . ($listeProduit[$i])['nomProduit'] . '</div>
                        <div class="card-body" id="user-info">' . ($listeProduit[$i])['prixHT'] . ' €
                        <div class = "quantiteProduit">
                            <form class="row container-fluid" action="/panier/moinsQte/' . ($listeProduit[$i])['idProduit'] . '"><input class = "moinsQte" type="submit" value="-"/></form>
                            '.($listeProduit[$i])['qteProduits'].'
                            <form class="row container-fluid" action="/panier/plusQte/' . ($listeProduit[$i])['idProduit'] . '"><input class = "plusQte" type="submit" value="+"/></form>
                        </div>
                <a href="/panier/suppression/' . ($listeProduit[$i])['idProduit'] . '">Supprimer</a><br><br>
                </div></div></aside></section>';

            }
            echo '
                <div class = "totalPanier">
                    <h2>Total panier HT</h2>
                    <table>
                        <tr><th>Total</th>
                        <td class = "total">' . ($listeProduit[0])['TotalPanier'] . '</td>
                        </tr></table>
                </div>
                
                <div class ="validation">
                    <form class="row container-fluid" action="/panier/check-out">
                        <input class="btn btn-success" type="submit" id="submit" value="Valider la commande">
                    </form>
                </div>
                </section>';
        }
    }

        function affichageCheckOut(){
        //TODO : affichage du récap de la commande
        ?>
            <section class="container content-block login-form">
                <form class="row container-fluid" action="/panier/commandeValide" method="post">
                    <div class="col-5 form-group mx-auto">
                        <div id = "detailsFact">
                            <h2>Détails de la facturation</h2>
                            <hr>
                            <label for="prenomFact">Prénom*</label>
                            <input name="prenomFact" type="text" class="form-control" required placeholder="Prénom*">
                            <label for="nomFact">Nom*</label>
                            <input name="nomFact" type="text" class="form-control" required placeholder="Nom*">
                            <label for="entrepriseFact">Entreprise (facultatif)</label>
                            <input name="entrepriseFact" type="text" class="form-control" placeholder="Nom de l'entreprise (facultatif)">
                            <label for="adresseFact">Numéro et nom de rue *</label>
                            <input name="adresseFact" type="text" class="form-control" required placeholder="Numéro et nom de rue *">
                            <label for="cpFact">Code postal *</label>
                            <input name="cpFact" type="text" class="form-control" required placeholder="Code postal *">
                            <label for="villeFact">Ville*</label>
                            <input name="villeFact" type="text" class="form-control" required placeholder="Ville*">
                            <label for="telFact">Téléphone*</label>
                            <input name="telFact" type="tel" class="form-control" required placeholder="Téléphone*">
                            <label for="emailFact">Adresse de messagerie*</label>
                            <input name="emailFact" type="email" class="form-control" required placeholder="Adresse de messagerie*">
                            <br>
                        </div>
                        <div class="detailsPaiement">
                            <h2>Mode de paiement</h2>
                            <hr>
                            <h3>Carte de paiement</h3>
                            <label for="numCarteFact">Numéro de carte *</label>
                            <input name="numCarteFact" type="text" class="form-control" required placeholder="Numéro de carte *">
                            <label for="dateExpfact">Date d'expiration *</label>
                            <input name="dateExpfact" type="date" class="form-control" required placeholder="Date d'expiration *">
                            <label for="cvc">CVC *</label>
                            <input name="cvc" type="number" class="form-control" required placeholder="CVC *">
                            <input name="condUtilisation" type="checkbox" required>J'ai lu et accepté.e les <a href="/conditions-generales-de-ventes/">conditions générales</a> *
                            <input class="btn btn-success" type="submit" id="submit" value="Commander">
                        </div>
                        <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
                    </div>
                </form>
            </section>
    <?php
    }

    function passageCommandeValide(){
        //TODO : rediriger car si la personne reste sur la page et rafraichit, message d'erreur car le panier n'existe plus.
        echo '<span class="info-utilisateur">Votre commande est passé avec succès.</span>';
    }

    function erreurPassageCommande(){
        //TODO : vérifier que la commande n'est vrmt pas passé
        echo '<span class="info-utilisateur">Votre commande n\'est pas passé.
         L\'achat a été annulé, veuillez réessayer.</span>';
    }

    function affichageProduitSup(){
        echo '<span class="info-utilisateur">Le produit a été supprimé.</span>';
    }

    function affichageSupProduitErreur(){
        echo '<span class="info-utilisateur">Il y a eu une erreur, le produit n\'a pas été supprimé, veuillez recommencer.</span>';
    }

    function affichageDMDUtilCo(){
        echo '<span class="info-utilisateur">Vous devez être connecté pour avoir un panier !</span>';
    }

}