<?php

require_once 'modules/generique/vue_generique.php';

class VuePanier extends VueGenerique
{

    function affichagePanier($listeProduit)
    { ?>
        <section class="login-form content-block">
            <div class="container">
                <h1>Panier</h1><hr> <?php
        if (empty($listeProduit)) {
            ?> <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info"><h1>Votre panier est vide, remplissez-le !<br/></h1></div>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/produits">Nos produits</a></h1>
            </div>
        </div><?php
        } else {
            ?><div class="row">
                    <aside class="col-lg p-1 m-2">
                    <div><?php
            for ($i = 0; $i < count($listeProduit); $i++) { ?>
                    <div class="card m-3">
                        <h4 class ="header text-center"> <?= ($listeProduit[$i])['nomProduit'] ?></h4>
                        <div class="card-body row mx-auto" id="user-info"> 
                        <div class="col-sm card-header text-center"> 
                            <span class="btn">Prix unitaire HT <?= ($listeProduit[$i])['prixHT'] ?> €</span>
                            <span class="btn">Prix sous-total HT <?=  ($listeProduit[$i])['prixHT'] * ($listeProduit[$i])['qteProduits'] ?> €</span>
                        </div>

                        <div class = "quantiteProduit col-sm-6">
                            <div class="row">
                                <form class="row col-sm p-1" action="/panier/plusQte/' . ($listeProduit[$i])['idProduit'] . '">
                                    <input class="plusQte form-control" type="submit" value="+"/>
                                </form>
                                <div class="text-center"> <? ($listeProduit[$i])['qteProduits'] ?></div>
                                <form class="row col-sm p-1" action="/panier/moinsQte/<?= ($listeProduit[$i])['idProduit'] ?>">
                                    <input class="moinsQte form-control" type="submit" value="-"/>
                                </form>
                            </div>
                        </div>
                        </div>
                <a class="btn btn-outline-danger" href="/panier/suppression/<?= ($listeProduit[$i])['idProduit'] ?>">Supprimer</a>
                </div><?php
            } ?>
            </div>
                </aside>             
                <aside class="col-lg-3 p-1 m-2">
                        <div class="card-footer">
                            <div class="totalPanier">
                            <h2>Total panier HT</h2>
                            <hr>
                            <table> <?php
            for ($i = 0; $i < count($listeProduit); $i++) {
               ?>
                            <tr>
                                <div>
                                    <h6 class="header m-2 text-end cart-txt">
                                        <?= ($listeProduit[$i])['nomProduit'].' x '. ($listeProduit[$i])['qteProduits'] . ' - ' . ($listeProduit[$i])['prixHT'] . ' €' ?>
                                    </h6>
                                </div>
                            </tr>
                        <?php
                        } ?>
                            <hr>
                                <tr><th>Votre total HT : </th>
                                <td class = "total"> <?= ($listeProduit[0])['TotalPanier'] ?></td>
                                </tr></table>
                                <hr>
                        </div>
                      
                        <div class ="validation">
                            <form class="row container-fluid" action="/panier/check-out">
                                <input class="btn btn-success" type="submit" id="submit" value="Valider la commande">
                            </form>
                        </div>
                    </div>
               </aside>
               </div>
            </section> <?php
        }
    }

    function affichageCheckOut()
    { ?>
        <section class="container content-block login-form">
            <form class="row container-fluid" action="/panier/commandeValide" method="post">
                <h1>Valider votre commande</h1>
                <hr>
                <div class="col-5 form-group mx-auto">
                    <div id="detailsFact">
                        <h2>Détails de la facturation</h2>
                        <hr>
                        <label for="prenomFact">Prénom*</label>
                        <input name="prenomFact" type="text" class="form-control" required placeholder="Prénom">
                        <label for="nomFact">Nom*</label>
                        <input name="nomFact" type="text" class="form-control" required placeholder="Nom">
                        <label for="entrepriseFact">Entreprise (facultatif)</label>
                        <input name="entrepriseFact" type="text" class="form-control" placeholder="Nom de l'entreprise (facultatif)">
                        <label for="adresseFact">Numéro et nom de rue *</label>
                        <input name="adresseFact" type="text" class="form-control" required placeholder="Numéro et nom de rue">
                        <label for="cpFact">Code postal *</label>
                        <input name="cpFact" type="text" class="form-control" required placeholder="Code postal">
                        <label for="villeFact">Ville*</label>
                        <input name="villeFact" type="text" class="form-control" required placeholder="Ville">
                        <label for="telFact">Téléphone*</label>
                        <input name="telFact" type="tel" class="form-control" required placeholder="Téléphone">
                        <label for="emailFact">Adresse de messagerie*</label>
                        <input name="emailFact" type="email" class="form-control" required placeholder="Adresse de messagerie">
                        <br>
                    </div>
                </div>
                <div class="col-5 form-group mx-auto">
                    <div class="detailsPaiement">
                        <h2>Mode de paiement</h2>
                        <hr>
                        <h3>Carte de paiement</h3>
                        <label for="numCarteFact">Numéro de carte *</label>
                        <input type="text" name="numCarteFact" class="form-control" required placeholder="Numéro de carte">
                        <label for="dateExpfact">Date d'expiration *</label>
                        <input name="dateExpfact" type="date" class="form-control" required placeholder="Date d'expiration">
                        <label for="cvc">CVC *</label>
                        <input name="cvc" type="text" class="form-control" required placeholder="CVC">
                        <div class="input-group">
                            <input class="m-1" name="condUtilisation" type="checkbox" required> J'ai lu et accepte.e les <a href="/conditions-generales-de-ventes/"> Conditions générales</a> *
                        </div>
                        <img class="w-25" src="\images\logo\moyens-paiement.png" alt="moyens de paiements">
                        <input class="btn btn-success form-control" type="submit" id="submit" value="Commander">

                    </div>
                    <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
                </div>
            </form>
        </section>
        <?php
    }

    function passageCommandeValide()
    {
        ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Votre commande a bien été prise en compte !</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/utilisa">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/utilisateur/mes-commandes">Mes commandes</a>
                </h1>
            </div>
        </div>
        <?php
    }

    function erreurPassageCommande()
    {
        ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Nous sommes désolés mais il semblerait qu'il y ait eu une erreur dans la commande.<br>
                        L'achat a été annulé, veuillez réessayer s'il vous plaît.<br>
                        Si le problème persiste, veuillez nous envoyer un e-mail à <u>contact@schoolaps.studio</u>.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/panier">Mon panier</a>
                </h1>
            </div>
        </div>
        <?php
    }

    function affichageProduitSup()
    {
        ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Le produit a bien été supprimé de votre panier.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/panier">Mon panier</a>
                </h1>
            </div>
        </div>
        <?php
    }

    function affichageSupProduitErreur()
    {
        ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Nous sommes désolés mais il semblerait qu'il y ait eu une erreur dans la suppression du produit,<br>
                        veuillez réessayer s'il vous plaît.<br>
                        Si le problème persiste, veuillez nous envoyer un e-mail à <u>contact@schoolaps.studio</u>.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/panier">Mon panier</a>
                </h1>
            </div>
        </div>
        <?php
    }

    function affichageDMDUtilCo()
    {
        ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Vous devez être connecté(e) pour avoir un panier !</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/connexion">Page de connexion</a>
                </h1>
            </div>
        </div>
        <?php
    }
}
