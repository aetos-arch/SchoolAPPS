<?php

require_once 'modules/generique/vue_generique.php';

class VueAdmin extends VueGenerique
{

	public function __construct()
	{
	    parent::__construct();
	}


    public function pageAccueilTech($moduleContent, $url)
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
                                            <a href="/technicien" class="btn btn-nav">Tableau de bord</a>
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
                                            <a class="dropdown-item" href="/technicien/mes-informations">Mes informations</a>
                                            <a class="dropdown-item" href="/technicien/changer-login">Changer mon login</a>
                                            <a class="dropdown-item" href="/technicien/nouveau-mot-de-passe">Changer mon mot de passe</a>
                                        </div>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="/technicien/mes-tickets" class="btn btn-nav">Mes Tickets</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="/technicien" class="btn btn-nav">Messagerie</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <div class="col-lg">
                            <h1>Votre espace technicien, <?php echo ucfirst($_SESSION['login']); ?> </h1>
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

	public function afficherTickets()
	{
	}

	public function afficherTicket($result)
	{
	}

	public function listeTechniciens($data)
	{
	}


	public function afficherStatistique($result)
	{
	}



    public function nouveauLogin()
    {
        echo '<h3>Changer de Login</h3>
		<hr class="mt-2 mb-4">
		
		<div class="card-panel  lighten-4">
			<form action="/technicien/changer-login" method="POST">
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
                        
                        <form action="/technicien/nouveau-mot-de-passe" method="post">
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
