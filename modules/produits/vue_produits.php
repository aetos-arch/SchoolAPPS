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
                            <div class="card-header text-center" id="produit-title"><h5 class="card-title"><?= $produit['nomProduit'] ?></h5></div>
                            <div class="card-footer text-center">Date de sortie - <?= $produit['dateSortie'] ?></div>
                            <div class="card-body">
                                <img class="w-50 center-img" src="../images/<?= $produit['nomProduit'] ?>.png">
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
                <h1 class="card-title"><?= $produit['nomProduit'] ?></h1>
                <div class="card-footer text-center">Date de sortie - <?= $produit['dateSortie'] ?></div>
                <div class="card-body">
                    <img class="w-25 center-img" src="\images\<?= $produit['nomProduit'] ?>.png">
                    <p class="card-text m-3"><?= $produit['description'] ?></p>
                    <a href="/produits/afficher-produit/<?= $produit['nomProduit'] ?>" class="btn btn-outline-success col-lg">Ajouter à mon panier</a>
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
            unset($produits);
    ?>
        </section>
        <?php
        include 'include\inc_sponsors.php';
	}

    public function erreurConnexionPanier()
    {
        echo "<main>Vous devez être connecté pour pouvoir ajouter un produit au panier.</main>";
    }

}
