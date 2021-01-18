<?php

require_once 'modules/generique/cont_generique.php';
require_once 'vue_technicien.php';
require_once 'modele_technicien.php';

class ContTechnicien extends ContGenerique
{

	public function __construct()
	{
        parent::__construct(new ModeleTechnicien(), new VueTechnicien());
	}

	public function nouveauMotDePasse()
	{
		$this->vue->nouveauMotDePasse();
		if (isset($_POST['nouveauMotDePasse2'])) {
			$nouveauMotDePasse1 = strip_tags($_POST['nouveauMotDePasse1']);
			$nouveauMotDePasse2 = strip_tags($_POST['nouveauMotDePasse2']);

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


    public function nouveauLogin()
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


	public function accueilTechnicien($moduleContent)
	{
		$this->vue->pageAccueilTech($moduleContent);
	}

	public function menu()
	{
		$this->vue->afficherMenu();
	}

	public function tableauBord()
	{
		$this->vue->tableauBord();
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


}
