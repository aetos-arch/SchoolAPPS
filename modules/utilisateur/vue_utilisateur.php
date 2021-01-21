<?php

require_once 'modules/generique/vue_generique.php';

class VueUtilisateur extends VueGenerique
{

	public function __construct()
	{
	}

	public function pageAccueilUtilisateur($moduleContent)
	{
		include 'include/inc_breadcrumb.php';
?>
		<section>
			<div class="content-block">
				<div class="container-fluid">
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
											<a class="dropdown-item" href="/technicien/profil">Mes informations</a>
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

			</div>
		</section>
	<?php
	}

	public function tableauBord()
	{
	?>
		<h3>Mon tableau de bord</h3>
		<section class="row">
			<h4>Tickets ouverts : </h4>
			<h4>Tickets fermés : </h4>
			<h4>Tickets urgents : </h4>
		</section>
	<?php
	}

	public function afficherMenu()
	{
	}

	public function afficheCommandes()
	{
	}

	public function afficheCommande()
	{
	}


	// ajouter le select produit
	public function nouveauTicket()
	{
		echo ' <h3>Création ticket</h3>
		<hr class="mt-2 mb-4">

		<form action="" method="POST">
			<div class="row">
				<div class="col-4 form-group">
					<label for="intitule">intitule</label>
					<input type="text" name="intitule" required value="intitule" class="form-control">
				</div>
				<div class="col-4 form-group">
					<label for="explication">explication</label>
					<textarea name="explication" required rows="5" cols="33" class="form-control">
				</div>
			<button type="submit" class="btn btn-primary d-block mb-2">Envoyer</button>
		</form>';
	}

	public function afficheTickets()
	{
	}

	public function afficheTicket()
	{
	}

	public function nouveauLogin()
	{
		echo '<h3>Changer de Login</h3>
		<hr class="mt-2 mb-4">
		
		<div class="card-panel  lighten-4">
			<form action="user/nouveauLogin" method="POST" >
				<div class="row">
					<div class="col-4 form-group">
						<label for="nouveauLogin">Nouveau Login</label>
						<input name="nouveauLogin" type="text" class="form-control">
						<button style="margin-top:20px;"class="btn btn-primary" type="submit" name="action">Valider</button>
					</div>
				</div>
			</form>
		</div>';
	}

	public function chat()
	{
	?>
  <link rel="stylesheet" href="../../css/app.css">

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
						<button type="submit">Send !</button>
					</form>
				</div>
			</section>
			<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
			<script src="../../js/appbis.js"></script>
		</body> <?php
			}

			public function json($result)
			{
				echo json_encode($result);
			}


			public function nouveauMotDePasse()
			{
				echo  '<h3>Changer votre mot de passe</h3>
		<hr class="mt-2 mb-4">
		
		<form action="" method="post">
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


			public function formDonnerAvis()
			{
				// to do
			}

			public function formModifierAvis($data)
			{
				// to do
			}
		}
