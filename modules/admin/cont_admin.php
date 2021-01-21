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

    public function accueilAdmin($moduleContent, $url)
    {
        $this->vue->pageAccueilAdmin($moduleContent, $url);
    }

    public function tableauBord()
    {
        $statsTickets = $this->modele->getNombreTicketsParEtat(($_SESSION['idUtil']));
        $profil = $this->modele->getProfil(($_SESSION['idUtil']));
        $this->vue->tableauBord($profil, $statsTickets);
    }

    public function profil()
    {
        $result = $this->modele->getProfil(($_SESSION['idUtil']));
        $this->vue->afficherProfil($result);
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
                    if ($_POST['old_password'] !== $nouveauMotDePasse1) {
                        $nouveauMotDePasseHash = password_hash($nouveauMotDePasse1, PASSWORD_BCRYPT);
                        $this->modele->setPass($nouveauMotDePasseHash, $_SESSION['idUtil']);
                        $this->vue->messageVue("Votre mot de passe a bien été modifié.");
                    } else
                        $this->vue->messageVue("Les trois mot de passe renseignés sont identiques !");
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


    public function listeTechniciens()
	{
		$data = $this->modele->getAllTechniciens();
		$this->vue->listeTechniciens($data);
	}

	public function afficherTicketsFerme()
	{
		$result = $this->modele->getTicketsEtat(0);
		$this->vue->afficherTickets($result);
	}

	public function afficherTicketsEnCours()
	{
		$result = $this->modele->getTicketsEtat(1);
		$this->vue->afficherTickets($result);
	}

	public function afficherTicketsUrgent()
	{
		$result = $this->modele->getTicketsEtat(2);
		$this->vue->afficherTickets($result);
	}

	public function afficherTicketsEnAttente()
	{
		$result = $this->modele->getTicketsEtat(3);
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
		$result = [
			'ferme' => $this->modele->getNombreTicketsEtat(0),
			'enCours' => $this->modele->getNombreTicketsEtat(1),
			'urgent' => $this->modele->getNombreTicketsEtat(2),
			'enAttente' => $this->modele->getNombreTicketsEtat(3),
		];

		$this->vue->afficherStatistique($result);
	}

	public function supprimerTechnicien($idTechnicien)
	{ 
		$this->modele->supprimerTechnicien($idTechnicien);
	}

	public function menu()
	{
		$this->vue->afficherMenu();
	}

	public function nouveauTechnicien()
	{
		if (isset($_POST['nom'])) {
			$result = [
				'prenom' => addslashes(strip_tags($_POST['prenom'])),
				'nom' => addslashes(strip_tags($_POST['nom'])),
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
