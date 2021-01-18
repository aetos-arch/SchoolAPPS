<?php
require_once 'modules/generique/cont_generique.php';
require_once 'vue_admin.php';
require_once 'modele_admin.php';

class ContAdmin extends ContGenerique
{

	public function __construct()
	{
	    parent::__construct(new ModeleAdmin, new VueAdmin());
	}

	public function afficherTickets()
	{
		$result = $this->modele->getTicketsEtat(1);
		$this->vue->afficherTickets($result);
	}


	public function afficherTicket()
	{
		$result = $this->modele->getTicket(strip_tags($_POST['idTicket']));
		$this->vue->afficherTicket($result);
	}

	public function assignerTicket()
	{
		if (isset($_POST['idTechnicien'])) {
			$this->modele->assignerTicket(strip_tags($_POST['idTechnicien']));
		}
	}

	public function supprimerTicket()
	{
		$idTicket = $_POST['idTicket'];
		$this->modele->supprimerTicket($idTicket);
	}

	public function gestionTechnicien()
	{
		$this->vue->afficherTechniciens();

		if (isset($_POST['idDelete'])) {
			$this->modele->supprimerTechnicien($_POST['idDelete']);
		}

		if (isset($_POST['nouveauTechnicien'])) {
			$this->modele->nouveauTechnicien($_POST['nouveauTechnicien']);
		}
	}

	public function statistique()
	{
		$result = $this->modele->stat();
		$this->vue->afficherStatistique($result);
	}

	public function nouveauLogin()
	{
		$this->vue->nouveauLogin();
		if (isset($_POST['nouveauLogin'])) {
			$nouveauLogin = strip_tags($_POST['nouveauLogin']);
			if ($this->modele->loginExiste($nouveauLogin) != 0) {
				// erreur Login existe déjà
				header('');
				exit();
			} else {
				$this->modele->setLogin($_SESSION['idUtil'], $nouveauLogin);
				$_SESSION['login'] = $nouveauLogin;
				header('');
				exit();
			}
		}
	}

	public function nouveauMotDePasse()
	{
		$this->vue->nouveauMotDePasse();
		if (isset($_POST['new_password2'])) {
			$nouveauMdp1 = strip_tags($_POST['new_password1']);
			$nouveauMdp2 = strip_tags($_POST['new_password2']);

			if ($nouveauMdp1 == $nouveauMdp2) {
				$passNow = $this->modele->getPass($_SESSION['idUtil']);
				if (password_verify($_POST['old_password'], $passNow)) {
					$nouveauMdpHash = password_hash($nouveauMdp1,  PASSWORD_BCRYPT);
					$this->modele->setPass($nouveauMdpHash, $_SESSION['idUtil']);
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
}
