<?php
require_once 'vue_admin.php';
require_once 'modele_admin.php';

class ContAdmin
{
	private $vue;
	private $modele;


	public function __construct()
	{
		$this->vue = new  VueAdmin();
		$this->modele = new  ModeleAdmin();
	}

	public function listTickets()
	{
		$result = $this->modele->getTickets();
		$this->vue->listTickets($result);
	}


	public function printTicket()
	{
		$result = $this->modele->getTicket($_POST['idTicket']);
		$this->vue->printTicket($result);
	}

	public function assignerTicket()
	{
		if (isset($_POST['idTechnicien'])) {
			$this->modele->assigneTicket($_POST['idTechnicien']);
		}
	}

	public function deleteTicket()
	{
	}

	public function gestionTechnicien()
	{
		$this->vue->printTechniciens();

		if (isset($_POST['idDelete'])) {
			$this->modele->deleteTechnicien($_POST['idDelete']);
		}

		if (isset($_POST['newTechnicien'])) {
			$this->modele->newTechnicien($_POST['newTechnicien']);
		}
	}

	public function stat()
	{
		$result = $this->modele->stat();
		$this->vue->stat($result);
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
				$_SESSION['nomadmin'] = $newPseudo;
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
}
