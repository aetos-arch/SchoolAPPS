<?php
require_once 'vue_technicien.php';
require_once 'modele_technicien.php';

class ContTechnicien
{
	private $vue;
	private $modele;


	public function __construct()
	{
		$this->vue = new  VueTechnicien();
		$this->modele = new  ModeleTechnicien();
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
}
