<?php

require_once 'modules/generique/vue_generique.php';

class VuePanier extends VueGenerique
{

    function affichagePanier($listeProduit)
    {
?>


        <?php
        if (empty($listeProduit)) {
            //TODO : Mise en page du message
        ?>
            <div class="container-fluid row">
                <div class="login-form">
                    <div class="big-info">
                        <h1>Votre panier est vide, remplissez-le !</h1>
                    </div>
                    <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a></h1>
                </div>
            </div>
        <?php
        } else {
            echo '   <section>
            <div class="row">
            <!--Grid column-->
            <div class="col-lg-8">

            <!-- Card -->
            <div class="mb-3">
            <div class="pt-4 wish-list">
            <h1 class="mb-4">Panier</h1>';

            for ($i = 0; $i < count($listeProduit); $i++) {
                echo '
                <div class="row mb-4">
                    <div class="col-md-7 col-lg-9 col-xl-9">
                        <div>
                            <div class="d-flex justify-content-between">
                                <h5>' . ($listeProduit[$i])['nomProduit'] . '</h5>
                                <div>
                                    <div class="def-number-input number-input safari_only mb-0 w-100">
                                        <form class="row container-fluid" action="/panier/moinsQte/' . ($listeProduit[$i])['idProduit'] . '">
                                            <input class="minus decrease" type="submit" value="-">
                                        </form>
                                        <label class="quantity" name="quantity" type="number">' . ($listeProduit[$i])['qteProduits'] . '</label>
                                         <form class="row container-fluid" action="/panier/plusQte/' . ($listeProduit[$i])['idProduit'] . '">
                                            <input class="plus increase" type="submit" value="+">
                                         </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="/panier/suppression/' . ($listeProduit[$i])['idProduit'] . '" type="button" class="card-link-secondary small text-uppercase mr-3">
                                    <i class="fas fa-trash-alt mr-1"></i>Supprimer l\'article</a>
                                </div>
                                <p class="mb-0"><span><strong id="summary">' . ($listeProduit[$i])['prixHT'] . ' €</strong></span></p class="mb-0">
                            </div>
                        </div>
                    </div>
                </div>
                         ';
            }
            /*echo '
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
                </section>';*/
        ?>
            </div>
            </div>
            </div>
            </div>
            </section>
        <?php
        }
    }

    function affichageCheckOut()
    {
        //TODO : affichage du récap de la commande
        ?>
        <section class="container content-block login-form">
            <form class="row container-fluid" action="/panier/commandeValide" method="post">
                <div class="col-5 form-group mx-auto">
                    <div id="detailsFact">
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

    function passageCommandeValide()
    {
        //TODO : rediriger car si la personne reste sur la page et rafraichit, message d'erreur car le panier n'existe plus.
        //TODO : voir ce qu'on peut avoir après la commande.
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Votre commande a été passé avec succès.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/utilisateur/mes-commandes">Mes commandes</a>
                </h1>
            </div>
        </div>
    <?php
    }

    function erreurPassageCommande()
    {
        //TODO : vérifier que la commande n'est vrmt pas passé
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
        //TODO : récupérer le nom du produit qui a été supprimé.
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
