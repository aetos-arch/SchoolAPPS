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

	public function nouveauMotDePasse()
	{
		$this->vue->nouveauMotDePasse();
		if (isset($_POST['nouveauMotDePasse2'])) {
			$nouveauMotDePasse1 = $_POST['nouveauMotDePasse1'];
			$nouveauMotDePasse2 = $_POST['nouveauMotDePasse2'];

			if ($nouveauMotDePasse1 == $nouveauMotDePasse2) {
				$passNow = $this->modele->getPass($_SESSION['idUtil']);
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
		$this->vue->afficheMenu();
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
}
