<?php
require_once 'vue_utilisateur.php';
require_once 'modele_utilisateur.php';

class ContUtilisateur
{
	private $vue;
	private $modele;


	public function __construct()
	{
		$this->vue = new  VueUtilisateur();
		$this->modele = new  ModeleUtilisateur();
	}


	public function nouveauLogin()
	{
		$this->vue->nouveauLogin();
		if (isset($_POST['nouveauLogin'])) {
			$nouveauLogin = htmlspecialchars($_POST['nouveauLogin']);
			if ($this->modele->loginExiste($nouveauLogin) != 0) {
				// erreur login existe déjà
				header('');
				exit();
			} else {
				$this->modele->setLogin($_SESSION['idUtil'], $nouveauLogin);
				$_SESSION['nomUser'] = $nouveauLogin;
				header('');
				exit();
			}
		}
	}

	public function nouveauMotDePasse()
	{
		$this->vue->nouveauMotDePasse();
		if (isset($_POST['nouveau_password2'])) {
			$nouveauMotDePasse1 = htmlspecialchars($_POST['nouveau_password1']);
			$nouveauMotDePasse2 = htmlspecialchars($_POST['nouveau_password2']);

			if ($nouveauMotDePasse1 == $nouveauMotDePasse2) {
				$passNow = $this->modele->getPassword($_SESSION['idUtil']);
				if (password_verify($_POST['old_password'], $passNow)) {
					$nouveauMotDePasseHash = password_hash($nouveauMotDePasse1,  PASSWORD_BCRYPT);
					$this->modele->setPass($nouveauMotDePasseHash, $_SESSION['idUtil']);
					header('');
					exit();
				} else {
					// ancien mot de passe incorrect
				}
			} else {
				// pass1 different de pass2
			}
		}
	}


	public function menu()
	{
		$this->vue->afficherMenu();
	}


	public function nouveauTicket()
	{
		$this->vue->nouveauTicket();
		if (isset($_POST['explication'])) {
			$result = [
				'explication' => htmlspecialchars($_POST['explication']),
				'intitule' => htmlspecialchars($_POST['intitule']),
				'idProduit' => htmlspecialchars($_POST['idProduit']),
				'idUtilisateur' => $_SESSION['idUtil']
			];
			$this->modele->creerTicket($result);
		}
	}

	public function afficheTickets()
	{
		$result = $this->modele->getTickets(($_SESSION['idUtil']));
		$this->vue->afficheTickets($result);
	}

	public function afficheTicket()
	{
		$idTicket = $_POST['idTicket'];
		$result = $this->modele->getTicket($idTicket);
		$this->vue->afficheTicket($result);
	}

	public function afficheCommandes()
	{
		$commandes = $this->modele->getCommandes($_SESSION['idUtil']);
		$this->vue->afficheCommandes($commandes);
	}

	public function afficheCommande()
	{
		$idCommande = $_POST['idCommande'];
		$result = $this->modele->getTicket($idCommande);
		$this->vue->afficheCommande($result);
	}
}
