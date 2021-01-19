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

    public function accueilTechnicien($moduleContent, $url)
    {
        $this->vue->pageAccueilTech($moduleContent, $url);
    }

    public function profil()
    {
        $this->vue->afficherProfil();
    }

	public function nouveauMotDePasse()
	{
		$this->vue->nouveauMotDePasse();
		$this->checkChangementMotDePasse();
	}


    public function checkChangementMotDePasse()
    {
        if (isset($_POST['nouveau_password2'])) {
            $nouveauMotDePasse1 = addslashes(strip_tags($_POST['nouveau_password1']));
            $nouveauMotDePasse2 = addslashes(strip_tags($_POST['nouveau_password2']));
            $passNow = $this->modele->getPass($_SESSION['idUtil']);
            if ($nouveauMotDePasse1 == $nouveauMotDePasse2 && $nouveauMotDePasse1 != "") {
                if (password_verify($_POST['old_password'], $passNow[0]['hashMdp'])) {
                    $nouveauMotDePasseHash = password_hash($nouveauMotDePasse1,  PASSWORD_BCRYPT);
                    $this->modele->setPass($nouveauMotDePasseHash, $_SESSION['idUtil']);
                    $this->vue->messageVue("Votre mot de passe a bien été modifié.");
                } else {
                    $this->vue->messageVue("Le mot de passe renseigné ne correspond pas au mot de passe actuel.");
                }
            } else {
                $this->vue->messageVue("Les deux nouveaux mot de passe ne sont pas identiques !");
            }
        }
    }



    public function nouveauLogin()
    {
        $this->vue->nouveauLogin();
        $this->soumettreLogin();

    }

    public function soumettreLogin() {
        if (isset($_POST['nouveauLogin']) && $_POST['nouveauLogin']!= "") {
            $nouveauLogin = addslashes(strip_tags($_POST['nouveauLogin']));
            if ($this->modele->loginExiste($nouveauLogin)) {
                $this->vue->messageVue("Vous ne pouvez pas remettre le login actuel");
            } else {
                $this->modele->setLogin($_SESSION['idUtil'], $nouveauLogin);
                $_SESSION['nomUser'] = $nouveauLogin;
                $this->vue->loginMisAjour($nouveauLogin);
            }
        }
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

	public function afficheTicket($idTicket)
	{
		//$idTicket = addslashes(strip_tags($_POST['idTicket']));
		$result = $this->modele->getTicket($idTicket);
		$this->vue->afficheTicket($result);
	}


}
