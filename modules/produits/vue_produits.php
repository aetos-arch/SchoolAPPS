<?php

require_once 'modules/generique/vue_generique.php';

class VueProduit extends VueGenerique
{

    public function __construct()
    {
    }

    public function afficherProduits($produits)
    {
        include 'include\inc_derniers_actus.php';
        ?>
        <div class="content-block" id="latest-articles">
            <div class="container">
                <section class="row">
                    <h1>Nos produits</h1>
                    <?php
                    foreach ($produits as &$produit) {
                        ?>
                        <article class="card bg-transparent col-lg m-2 p-1">
                            <div class="card-header text-center" id="produit-title"><h5 class="card-title product-title"><?= $produit['nomProduit'] ?></h5></div>
                            <div class="card-footer text-center">Date de sortie - <?= $produit['dateSortie'] ?></div>
                            <div class="card-body">
                                <img class="w-50 center-img" src="\images\logo\<?= $produit['nomProduit'] ?>.png">
                                <p class="card-text m-3"><?= $produit['description'] ?></p>

                            </div>
                            <a href="/produits/afficher-produit/<?= $produit['nomProduit'] ?>" class="btn btn-primary">Voir plus</a>
                        </article>
                        <?php
                    }
                    unset($produits);
                    ?>
                </section>
            </div>
        </div>
        <?php
        include 'include\inc_sponsors.php';
    }

    public function afficherProduit($produit)
    {
        include 'include\inc_derniers_actus.php';
        ?>
        <div class="content-block">
            <div class="container">
                <h1 class="card-title product-title"><?= $produit['nomProduit'] ?></h1>
                <div class="card-footer text-center">Date de sortie - <?= $produit['dateSortie'] ?></div>
                <div class="card-body">
                    <img class="w-25 center-img" src="\images\logo\<?= $produit['nomProduit'] ?>.png">
                    <p class="card-text m-3"><?= $produit['description'] ?></p>
                </div>
                <div class="card-footer row">
                    <a href="/produits/ajouter-au-panier/<?= $produit['idProduit'] ?>" class="btn btn-outline-success col-lg-4 mx-auto">
                        Ajouter à mon panier
                    </a>
                    <?php if(isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur']==3) { ?>
                        <a href="/produits/ajouter-avis/<?= $produit['idProduit'] ?>" class="btn btn-outline-secondary col-lg-4 mx-auto">
                            Ajouter un avis
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function listerAvis($allAvis, $estUtilisateur)
    { ?>
        <h1>Les avis</h1>
        <section class="row" id="latest-articles">
            <?php
            foreach ($allAvis as &$avis) {
                ?>
                <article class="avis card col-lg-8 m-2 p-1">
                    <div class="card-header text-center" id="produit-title"><h5 class="card-title">Avis de <?= $avis['login'] ?></h5></div>
                    <div class="card-footer text-center">Evaluation : <?= $avis['noteProduit'] ?> / 5</div>
                    <div class="card-body">
                        <p class="card-text m-3"><?= $avis['avis'] ?></p>
                    </div>
                </article>
                <?php
            }
            unset($avis);
            ?>
        </section>
        <?php
        include 'include\inc_sponsors.php';
    }

    public function formDonnerAvis($idProduit)
    { ?>

        <section class="container content-block login-form">
            <h1>Mon avis</h1>
            <hr>
            <form class="row" action="/produits/ajouter-avis/<?=$idProduit?>" method="POST">
                <aside class="container-fluid mx-auto">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="titre">Titre</label>
                            <input name="titre" type="text" class="form-control" required placeholder="Titre de l'avis">
                            <label for="nouveauLogin">Note</label>
                            <select name="note" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                            <button class="btn btn-primary " type="submit" name="action">Valider</button>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="commentaire">Votre commentaire</label>
                            <textarea name="commentaire" type="text" class="form-control" required placeholder="Votre commentaire" rows="4"></textarea>
                        </div>
                    </div>
                </aside>
            </form>
        </section>
        <?php
    }

    public function erreurConnexionPanier()
    {
        ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info"><h1>Vous devez être connecté pour pouvoir ajouter un produit au panier.</h1></div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/connexion">Se connecter ou s'inscrire</a></h1>
            </div>
        </div>
        <?php
    }
}
