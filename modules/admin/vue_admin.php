<?php

require_once 'modules/generique/vue_generique.php';

class VueAdmin extends VueGenerique
{

	public function __construct()
	{
	    parent::__construct();
	}


    public function pageAccueilAdmin($moduleContent, $url)
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
                                            <a href="/admin" class="btn btn-nav">Tableau de bord</a>
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
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <a class="dropdown-item" href="/admin/mes-informations">Mes informations</a>
                                            <a class="dropdown-item" href="/admin/changer-login">Changer mon login</a>
                                            <a class="dropdown-item" href="/admin/nouveau-mot-de-passe">Changer mon mot de passe</a>
                                        </div>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="/admin/les-tickets" class="btn btn-nav">Voir les tickets</a>
                                        </div>
                                    </div>
                                </li>
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <button class="btn btn-nav dropdown-toggle" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                                                Les techniciens
                                            </button>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <a class="dropdown-item" href="/admin/liste-techniciens">Liste des techniciens</a>
                                            <a class="dropdown-item" href="/admin/nouveau-technicien">Nouveau technicien</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </nav>
                        <div class="col-lg-7">
                            <h1>Votre espace administrateur, <?php echo ucfirst($_SESSION['login']); ?> </h1>
                            <?= $moduleContent ?>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <?php
    }

    public function tableauBord($profil, $stats)
    {
        ?>
        <h3>Mon tableau de bord</h3>
        <section class="row">
            <?php
            $this->afficherProfil($profil);
            $this->statsTickets($stats);
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
                <div class="card-body">
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
                    <h4>Statistique</h4>
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


    public function afficheTickets($result)
    { ?>
            <div class="m-2 p-2">
                <a href="/admin/tickets-en-attente" class="btn btn-outline-primary">Tickets en attente</a>
                <a href="/admin/tickets-fermes" class="btn btn-outline-primary">Tickets fermés</a>
                <a href="/admin/tickets-en-cours" class="btn btn-outline-primary">Tickets en cours</a>
                <a href="/admin/tickets-urgent" class="btn btn-outline-primary">Tickets urgents</a>
            </div>

            <?php

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
                        <a class="btn lire-plus col-3" href="/admin/ticket/<?= $ticket['idTicket'] ?>">Voir plus</a>
                    </div>
                </div>
            </div>
            <?php
        }
        unset($ticket);
    }

    public function afficheTicket($ticket, $infoClient, $infoTech, $techinicien)
    {
        ?>
        <div class="row">
            <aside class="card col-lg-7 p-1 m-2">
                <div class="card-header">
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
                    <h4 class="d-inline">
                        <span class="info"> N°<?= $ticket['idTicket'] ?></span>
                        <span class="info"> - <?= $ticket['intitule'] ?></span>
                    </h4>
                    <h4 <span class="info"> État <?= $ticket['etat']; ?></span>
                    <span class="info"> - Id-Produit: <?= $ticket['idProduit']; ?></span>
                    </h4>
                </div>
                <div class="col-lg card-body">
                    <p id="explication"><?= $ticket['explication']; ?></p>
                    <button class="btn btn-outline-primary" type="button" onclick="document.getElementById('explication').style.display = 'inherit'">Lire la suite</button>
                    <button class="btn btn-outline-primary" type="button" onclick="document.getElementById('explication').style.display = '-webkit-box'">Réduire</button>
                    <div class="col-lg card-body">
                        <form method="post" action="/admin/assigner-ticket/<?= $ticket['idTicket'] ?>" class="input-group">
                            <select class="custom-select form-control" id="inputGroupSelect04" name="idTechnicien">
                                <option selected>Choisir...</option>
                                <?php
                                foreach ($techinicien as &$technicien) {
                                    ?> <option value="<?= $technicien['idUtilisateur'] ?>"><?= ucfirst($technicien['nom']) ?></option>
                                    <?php
                                }
                                unset($technicien);
                                ?>
                            </select>
                            <div class="input-group-append">
                                <input class="btn btn-outline-success" type="submit" value="Assigner">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg card-footer">
                    <a class="btn lire-plus-r" href="/admin/supprimer-ticket/<?= $ticket['idTicket'] ?>">Supprimer ce ticket</a>
                </div>
            </aside>
            <aside class="container-fluid col-lg-4 p-1 m-2" id="info-client">
                <div class="row">
                    <div class="card">
                        <div class="col-lg card-header">
                            <h4 class="d-inline">Informations du client</h4>
                        </div>
                        <div class="col-lg card-body">
                            Nom : <?= $infoClient['nom'] ?> <br>
                            Prenom : <?= $infoClient['prenom'] ?> <br>
                            Email : <?= $infoClient['emailFacturation'] ?> <br>
                            Telephone : <?= $infoClient['telephone'] ?> <br>
                        </div>
                        <div class="col-lg card-header">
                            <h4 class="d-inline">Informations du technicien</h4>
                        </div>
                        <div class="col-lg card-body">
                            Nom : <?= $infoTech['nom'] ?> <br>
                            Prenom : <?= $infoTech['prenom'] ?> <br>
                            Email : <?= $infoTech['emailFacturation'] ?> <br>
                            Telephone : <?= $infoTech['telephone'] ?> <br>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <?php
    }


	public function listeTechniciens($techniciens)
	{
	    ?><h3>Liste des techniciens</h3><?php
        foreach ($techniciens as &$technicien) {
            ?>
            <div class="col-lg-10 text-center card-header">
                Nom : <?= $technicien['nom'] ?> <br>
                Prenom : <?= $technicien['prenom'] ?> <br>
                Email : <?= $technicien['emailFacturation'] ?> <br>
                Telephone : <?= $technicien['telephone'] ?> <br>
                <div class="card col-4 mx-auto">
                    <a class="btn btn-danger" href="/admin/supprimer-technicien/<?= $technicien['idUtilisateur'] ?>">Supprimer ce technicien</a>
                </div>
            </div>
            <?php
        }
        unset($technicien);
	}

    public function nouveauTechnicien()
    {?>
        <h1>Inscription</h1>
        <hr>
        <form class="row container-fluid" action="/admin/nouveau-technicien" method="POST">
            <div class="col-lg form-group mx-auto">

                <label for="login">Nom d'utilisateur*</label>
                <input name="login" type="text" class="form-control" required placeholder="Nom d'utilisateur">

                <label for="nom">Nom*</label>
                <input name="nom" type="text" class="form-control" required placeholder="Nom">

                <label for="prenom">Prénom*</label>
                <input name="prenom" type="text" class="form-control" required placeholder="Prénom">

                <label for="eFacturation">Adresse e-mail de facturation*</label>
                <input name="eFacturation" type="email" class="form-control" required placeholder="E-mail de facturation">

                <label for="tel">Téléphone*</label>
                <input name="tel" type="tel" class="form-control" required placeholder="Téléphone">

                <input type="submit" id="submit" value="Créer un compte" class="btn btn-success">
                <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
            </div>
        </form>
    <?php
    }

    public function nouveauLogin()
    {
        echo '<h3>Changer de Login</h3>
		<hr class="mt-2 mb-4">
		
		<div class="card-panel  lighten-4">
			<form action="/admin/changer-login" method="POST">
				<div class="row">
					<div class="col-4 form-group">
						<label for="nouveauLogin">Login</label>
						<input name="nouveauLogin" type="text" class="form-control" required pattern="\S+.*" placeholder="Votre nouveau login">
						<button class="btn btn-primary " type="submit" name="action">Valider</button>
					</div>
				</div>
			</form>
		</div>';
    }

    public function loginMisAjour($newLogin)
    {
        ?> <span class="alert-warning">Votre login a bien été mis à jour<br>
            (Lors de votre prochaine connexion il faudra utiliser celui-ci : <?= $newLogin ?>)</span><?php
    }


    public function nouveauMotDePasse()
    {
        echo  '<h3>Changer votre mot de passe</h3>
                        <hr class="mt-2 mb-4">
                        
                        <form action="/admin/nouveau-mot-de-passe" method="post">
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
                        </form>';
    }
}
