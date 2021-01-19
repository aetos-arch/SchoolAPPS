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

	
	public function listeTechniciens () {
		$data = $this->modele->getAllTechniciens();
		$this->vue->listeTechniciens($data);
	}

	public function afficherTickets()
	{
		$result = $this->modele->getTicketsEtat(1);
		$this->vue->afficherTickets($result);
	}


	public function afficherTicket($idTicket)
	{
		$result = $this->modele->getTicket(addslashes(strip_tags($idTicket)));
		$this->vue->afficherTicket($result);
	}

	public function assignerTicket()
	{
		if (isset($_POST['idTechnicien'])) {
			$this->modele->assignerTicket(addslashes(strip_tags($_POST['idTechnicien'])));
		}
	}

	public function supprimerTicket()
	{
		$idTicket = addslashes(strip_tags($_POST['idTicket']));
		$this->modele->supprimerTicket($idTicket);
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
			$nouveauLogin = addslashes(strip_tags($_POST['nouveauLogin']));
			if ($this->modele->loginExiste($nouveauLogin) != 0) {
				$this->loginExiste();
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
			$nouveauMotDePasse1 = addslashes(strip_tags($_POST['nouveau_password1']));
			$nouveauMotDePasse2 = addslashes(strip_tags($_POST['nouveau_password2']));
			if ($nouveauMotDePasse1 == $nouveauMotDePasse2 && $nouveauMotDePasse1 != "") {
				$passNow = $this->modele->getPassword($_SESSION['idUtil']);
				if (password_verify($_POST['old_password'], $passNow)) {
					$nouveauMotDePasseHash = password_hash($nouveauMotDePasse1,  PASSWORD_BCRYPT);
					$this->modele->setPass($nouveauMotDePasseHash, $_SESSION['idUtil']);
					header('');
					exit();
				} else {
					$this->loginExiste();
				}
			} else {
				$this->motDePasseNonIdentique();
			}
		}
	}

	public function supprimerTechnicien ($idTechnicien) {
		$this->modele->supprimerTechnicien();
	}


	public function menu()
	{
		$this->vue->afficherMenu();
	}

	public function nouveauTechnicien () {
		if (isset($_POST['nom'])) {
			$result = [
				'prenom' => $_SESSION['prenom'],
				'nom' => addslashes(strip_tags($_POST['login'])),
				'login' => addslashes(strip_tags($_POST['login'])),
				'hashMdp' => "bienvenue",
				'telephone' => addslashes(strip_tags($_POST['telephone']))
			];
			try {
				$this->verifTableauValeurNull($result);
				$this->modele->nouveauTechnicien($result);
			} catch (Exception $e) {
				$e->getMessage();
			}
			
		} else {
			$this->vue->nouveauTechnicien();
		}
	}

}
