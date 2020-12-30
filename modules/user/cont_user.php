<?php
require_once 'vue_user.php';
require_once 'modele_user.php';

class ContUser
{
	private $vue;
	private $modele;


	public function __construct()
	{
		$this->vue = new  VueUser();
		$this->modele = new  modeleUser();
	}


	public function newPseudo()
	{
		$this->vue->newPseudo();
		if (isset($_POST['newPseudo'])) {
			$newPseudo = htmlspecialchars($_POST['newPseudo']);
			if ($this->modele->pseudoExiste($newPseudo) != 0) {
				// erreur pseudo existe déjà
				header('');
				exit();
			} else {
				$this->modele->setPseudo($_SESSION['idUtil'], $newPseudo);
				$_SESSION['nomUser'] = $newPseudo;
				header('');
				exit();
			}
		}
	}

	public function newPass()
	{
		$this->vue->newPass();
		if (isset($_POST['new_password2'])) {
			$newPass1 = $_POST['new_password1'];
			$newPass2 = $_POST['new_password2'];

			if ($newPass1 == $newPass2) {
				$passNow = $this->modele->getPassword($_SESSION['idUtil']);
				if (password_verify($_POST['old_password'], $passNow)) {
					$newPassHash = password_hash($newPass1,  PASSWORD_BCRYPT);
					$this->modele->setPass($newPassHash, $_SESSION['idUtil']);
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
		$this->vue->printMenu();
	}


	public function newTicket()
	{
		$this->vue->newTicket();
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

	public function listTickets()
	{
		$result = $this->modele->getTickets(($_SESSION['idUtil']));
		$this->vue->listTickets($result);
	}

	public function printTicket()
	{
		$idTicket = $_POST['idTicket'];
		$result = $this->modele->getTicket($idTicket);
		$this->vue->printTicket($result);
	}

	public function listCommandes()
	{
		$commandes = $this->modele->getCommandes($_SESSION['idUtil']);
		$this->vue->listCommandes($commandes);
	}

	public function printCommande()
	{
		$idCommande = $_POST['idCommande'];
		$result = $this->modele->getTicket($idCommande);
		$this->vue->printCommande($result);
	}
}
