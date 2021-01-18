<?php

require_once 'modules/generique/cont_generique.php';
require_once 'vue_utilisateur.php';
require_once 'modele_utilisateur.php';

class ContUtilisateur extends ContGenerique
{

	public function __construct()
	{
        parent::__construct(new ModeleUtilisateur(), new VueUtilisateur());
	}

    public function accueilUtilisateur($moduleContent)
    {
        $this->vue->pageAccueilUtilisateur($moduleContent);
    }

    public function tableauBord()
    {
        $this->vue->tableauBord();
    }

    public function nouveauLogin()
	{
		$this->vue->nouveauLogin();
		if (isset($_POST['nouveauLogin'])) {
			$nouveauLogin = strip_tags($_POST['nouveauLogin']);
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
			$nouveauMotDePasse1 = strip_tags($_POST['nouveau_password1']);
			$nouveauMotDePasse2 = strip_tags($_POST['nouveau_password2']);
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
		if (isset($_POST['explication'])) {
			$result = [
				'explication' => strip_tags($_POST['explication']),
				'intitule' => strip_tags($_POST['intitule']),
				'idProduit' => strip_tags($_POST['idProduit']),
				'idUtilisateur' => $_SESSION['idUtil']
			];

			if ($this->verifTableauPasVide($result)) {
				$this->modele->creerTicket($result);
			} else {
				// exception
			}
		} else {
			$this->vue->nouveauTicket();
		}
	}

	public function afficheTickets()
	{
		$result = $this->modele->getTickets(($_SESSION['idUtil']));
		$this->vue->afficheTickets($result);
	}

	public function afficheTicket()
	{
		$idTicket = strip_tags($_POST['idTicket']);
		$result = $this->modele->getTicket($idTicket);
		$this->vue->afficheTicket($result);
	}

	public function afficheCommandes()
	{
		//$commandes = $this->modele->getCommandes($_SESSION['idUtil']);
		$commandes = $this->modele->getCommandes(1);
		var_dump($commandes);
		$this->vue->afficheCommandes($commandes);
	}

	public function afficheCommande()
	{
		$idCommande = strip_tags($_POST['idCommande']);
		$result = $this->modele->getTicket($idCommande);
		$this->vue->afficheCommande($result);
	}
}
