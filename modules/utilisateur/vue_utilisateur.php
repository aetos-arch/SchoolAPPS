<?php

require_once 'modules/generique/vue_generique.php';

class VueUtilisateur extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function pageAccueilUtilisateur($moduleContent, $url)
    {
        include 'include/inc_breadcrumb.php';
?>
        <section>
            <div class="content-block">
                <div class="container">
                    <section class="row">
                        <nav class="col-lg-3" id="sideNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="/utilisateur" class="btn btn-nav">Tableau de bord</a>
                                        </div>
                                    </div>
                                </li>
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <button class="btn btn-nav dropdown-toggle" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Votre profil
                                            </button>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="mes infos" data-parent="#accordion">
                                            <a class="dropdown-item" href="/utilisateur/mes-informations">Mes informations</a>
                                            <a class="dropdown-item" href="/utilisateur/changer-login">Changer mon login</a>
                                            <a class="dropdown-item" href="/utilisateur/nouveau-mot-de-passe">Changer mon mot de passe</a>
                                        </div>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="/utilisateur/mes-commandes" class="btn btn-nav">Mes commandes</a>
                                        </div>
                                    </div>
                                </li>
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <button class="btn btn-nav dropdown-toggle" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                                Vos tickets
                                            </button>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="tickets" data-parent="#accordion">
                                            <a class="dropdown-item" href="/utilisateur/mes-tickets">Mes tickets</a>
                                            <a class="dropdown-item" href="/utilisateur/nouveau-ticket">Ouvrir un ticket</a>
                                        </div>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="/utilisateur/mes-avis" class="btn btn-nav">Mes avis</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <div class="col-lg">
                            <h1>Votre espace, <?php echo ucfirst($_SESSION['login']); ?> </h1>
                            <?= $moduleContent ?>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    <?php
    }

    public function tableauBord($profil, $stats, $commandes)
    {
    ?>
        <h3>Mon tableau de bord</h3>
        <section class="row">
            <?php
            $this->afficherProfil($profil);
            $this->statsTickets($stats);
            $this->dernieresCommandes($commandes);
            ?>
        </section>
    <?php
    }

    public function afficherProfil($profil)
    {
    ?>
        <aside class="col-lg-12 p-1 m-2">
            <div class="card">
                <div class="card-header">
                    <h4>Vous</h4>
                </div>
                <div class="card-body" id="user-info">
                    Nom : <?= $profil['nom'] ?> <br>
                    Prénom : <?= $profil['prenom'] ?> <br>
                    E-mail : <?= $profil['emailFacturation'] ?> <br>
                    Téléphone : <?= $profil['telephone'] ?> <br>
                </div>
            </div>
        </aside>
    <?php
    }

    public function statsTickets($stats)
    {
    ?>
        <aside class="col-lg-12 p-1 m-2">
            <div class="card">
                <div class="card-header">
                    <h4>Tickets</h4>
                </div>
                <div class="card-body">
                    <?php
                    foreach ($stats as &$ticket) {
                    ?><h5>Tickets <?= $ticket['etat'] ?> : <?= $ticket['nbr'] ?> </h5>
                    <?php
                    }
                    unset($ticket);
                    ?>
                </div>
            </div>
        </aside>
    <?php
    }

    public function dernieresCommandes($commandes)
    {
    ?>
        <aside class="col-lg-12 p-1 m-2">
            <div class="card">
                <div class="card-header">
                    <h4>Vos dernières commandes</h4>
                </div>

                <?php
                foreach ($commandes as &$commande) {
                ?>
                    <div class="card-body" id="user-info">
                        IdCommande : <?= $commande['idCommandes'] ?> <br>
                        Date : <?= $commande['dateAchat'] ?> <br>
                    </div>
                <?php
                }
                unset($commande);
                ?>

            </div>
            <div class="card-footer"><a class="btn lire-plus col" href="/utilisateur/mes-commandes">Voir toutes mes commandes</a></div>
        </aside>
        <?php
    }

    public function afficheCommandes($commandes)
    {
        foreach ($commandes as &$commande) {
        ?>
            <div class="ticket row card">
                <div class="col-lg card-header">
                    <h4 class="d-inline">Commande - Ref N° <?= $commande['idCommandes'] ?></h4>
                </div>
                <div class="col-lg card-footer">
                    <div class="row">
                        <span class="col-8">
                            Commandé le : <?= $commande['dateAchat']; ?>
                        </span>
                        <a class="btn lire-plus col-3" href="/utilisateur/commande/<?= $commande['idCommandes'] ?>">Détails de la commande</a>
                    </div>
                </div>
            </div>
        <?php
        }
        unset($commande);
    }

    public function afficheCommande($produitsCommandes)
    {
        ?>
        <div class="row">
            <aside class="card col-lg p-1 m-2">
                <div class="col-lg card-header">
                    <h4 class="d-inline">Info commandes</h4>
                </div>
                <div class="col-lg card-body">
                    Ref de la commande : <?= $produitsCommandes[0]['idCommandes'] ?> | Date de commande : <?= $produitsCommandes[0]['dateAchat']; ?><br>
                </div>
                <div class="card-header">
                    <h4 class="d-inline">Listes des produits</h4>
                </div>
                <?php
                foreach ($produitsCommandes as &$produit) { ?>
                    <div class="col-lg card-header">
                        <p id="explication">
                            Nom produit : <?= $produit['nomProduit']; ?><br>
                            Quantité : <?= $produit['qteProduit']; ?><br>
                            Prix unitaire HT : <?= $produit['prixHT']; ?>
                        <p>
                        <p>Description : <?= $produit['description']; ?></p>
                        <div class="card-body">
                            <a class="btn btn-outline-success" href="/utilisateur/nouveau-ticket/<?= $produit['nomProduit']; ?>">Ouvir un ticket pour ce produit</a>
                        </div>
                    </div>
                <?php
                }
                unset($produit)
                ?>
            </aside>
        </div>
    <?php
    }


    // ajouter le select produit
    public function nouveauTicket($produits, $default)
    { ?>
        <h3>Création ticket</h3>
        <hr class="mt-2 mb-4">

        <form action="" method="POST">
            <div class="row">
                <div class="row">
                    <div class="col form-group">
                        <label for="intitule">Intitulé</label>
                        <input type="text" name="intitule" required pattern="\S+.*" class="form-control">
                    </div>
                    <div class="col form-group">
                        <label for="produit">Produit concerné</label>
                        <select class="custom-select form-control" id="inputGroupSelect04" name="idProduit" required>
                            <option <?= (is_null($default) ? 'selected' : '') ?>>Choisir...</option>
                            <?php
                            foreach ($produits as &$produit) {
                            ?> <option <?= ((!is_null($default) && $default === $produit['nomProduit']) ? 'selected' : '') ?> value="<?= $produit['idProduit'] ?>"><?= ucfirst($produit['nomProduit']) ?></option>
                            <?php
                            }
                            unset($etat);
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg form-group">
                    <label for="explication">Votre message</label>
                    <textarea name="explication" required pattern="\S+.*" rows="5" cols="33" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Envoyer</button>
        </form>
        <?php
    }

    public function afficheTickets($result)
    {
        foreach ($result as &$ticket) {
        ?>
            <div class="ticket row card">
                <div class="col-lg card-header">
                    <?php
                    switch ($ticket['etat']) {
                        case 'Urgent':
                            echo '<img class="m-2" src="\..\images\etats\Urgent.png">';
                            break;
                        case 'En cours':
                            echo '<img class="m-2" src="\..\images\etats\En cours.png">';
                            break;
                        case 'Fermé':
                            echo '<img class="m-2" src="\..\images\etats\Fermé.png">';
                            break;
                        case 'En attente':
                            echo '<img class="m-2" src="\..\images\etats\En attente.png">';
                            break;
                    }
                    ?>
                    <h4 class="d-inline"><?= $ticket['intitule'] ?> - N°<?= $ticket['idTicket'] ?></h4>
                </div>
                <div class="col-lg card-body">
                    <p id="explication"><?= $ticket['explication']; ?></p>
                </div>
                <div class="col-lg card-footer">
                    <div class="row">
                        <span class="col-8">
                            État : <?= $ticket['etat']; ?> - Id-Produit : <?= $ticket['idProduit']; ?> - le : <?= $ticket['dateCreation']; ?>
                        </span>
                        <a class="btn lire-plus col-3" href="/utilisateur/ticket/<?= $ticket['idTicket'] ?>">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php
        }
        unset($ticket);
    }

    public function afficheTicket($ticket, $infoTech)
    {
        ?>
        <div class="row">
            <aside class="card col-lg-7 p-1 m-2">
                <div class="card-header">
                    <h4>
                        <span class="info"> N°<?= $ticket['idTicket'] ?></span>
                        <span class="info"> - <?= $ticket['intitule'] ?></span>
                    </h4>
                    <h4 <span class="info"> État <?= $ticket['etat']; ?></span>
                        <span class="info"> - Id-Produit : <?= $ticket['idProduit']; ?></span>
                    </h4>
                </div>
                <div class="col-lg card-body">
                    <p id="explication"><?= $ticket['explication']; ?></p>
                    <button class="btn btn-outline-primary" type="button" onclick="document.getElementById('explication').style.display = 'inherit'">Lire la suite</button>
                    <button class="btn btn-outline-primary" type="button" onclick="document.getElementById('explication').style.display = '-webkit-box'">Réduire</button>
                </div>
                <div class="col-lg card-footer">
                    <a class="btn lire-plus-r" id="btn-chat" href="/utilisateur/chat/<?= $ticket['idTicket'] ?>">Chat</a>
                </div>
            </aside>
            <aside class="card col-lg-4 p-1 m-2" id="info-client">
                <div class="col-lg card-header">
                    <h4 class="d-inline">Info du technicien</h4>
                </div>
                <div class="col-lg card-body">
                    Nom : <?= $infoTech['nom'] ?> <br>
                    Prénom : <?= $infoTech['prenom'] ?> <br>
                    E-mail : <?= $infoTech['emailFacturation'] ?> <br>
                    Téléphone : <?= $infoTech['telephone'] ?> <br>
                </div>
            </aside>
        </div>
    <?php
    }

    public function nouveauLogin()
    {
        ?><h3>Changer de Login</h3>
		<hr class="mt-2 mb-4">
		
		<div class="card-panel  lighten-4">
			<form action="/utilisateur/changer-login" method="POST">
				<div class="row">
					<div class="col-4 form-group">
						<label for="nouveauLogin">Login</label>
						<input name="nouveauLogin" type="text" class="form-control" required pattern="\S+.*" placeholder="Votre nouveau login">
						<button class="btn btn-primary " type="submit" name="action">Valider</button>
					</div>
				</div>
			</form>
		</div><?php
    }

    public function chat()
    {
    ?>
        <link rel="stylesheet" href="../../css/chat.css">

        <body>
            <header>
                <h1>Chat</h1>
            </header>

            <section class="chat">
                <div class="messages">
                </div>
                <div class="user-inputs">
                    <form id="envoiMessage" method="POST">
                        <input type="text" id="content" name="content" placeholder="Envoyer message">
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
            </section>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <script src="../../js/chatbis.js"></script>
        </body> <?php
            }

            public function json($result)
            {
                echo json_encode($result);
            }

        public function loginMisAjour($newLogin)
            {
                ?> <span class="alert-warning">Votre login a bien été mis à jour<br>
            (Lors de votre prochaine connexion il faudra utiliser celui-ci : <?= $newLogin ?>)</span><?php
            }

            public function nouveauMotDePasse()
            { ?>
                <h3>Changer votre mot de passe</h3>
                <hr class="mt-2 mb-4">

                <form action="/utilisateur/nouveau-mot-de-passe" method="post">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="old_password">Ancien mot de passe</label>
                            <input type="password" name="old_password" class="form-control" required>
                        </div>
                        <div class="col-4 form-group">
                            <label for="nouveau_password1">Nouveau mot de passe</label>
                            <input type="password" name="nouveau_password1" class="form-control" required>
                        </div>

                        <div class="col-4 form-group">
                            <label for="nouveau_password2">Confirmation mot de passe</label>
                            <input type="password" name="nouveau_password2" class="form-control" required>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                </form>
                <?php
            }

    public function listerAvis($allAvis)
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
                    <div class="col-lg card-footer"><a class="btn lire-plus-r" href="/utilisateur/supprimer-avis/<?= $avis['idAvis'] ?>">Supprimer</a></div>
                </article>
                <?php
            }
            unset($avis);
            ?>
        </section>
        <?php
        include 'include\inc_sponsors.php';
    }
}
