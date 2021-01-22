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

    public function afficheTickets()
    {
        $tickets = $this->modele->getAllTickets();
        $this->vue->afficheTickets($tickets);
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
                        //header('Location: /admin/nouveau-mot-de-passe');
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
            //header('Location: /admin/changer-login');
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
		$this->vue->afficheTickets($result);
	}

	public function afficherTicketsEnCours()
	{
		$result = $this->modele->getTicketsEtat(1);
		$this->vue->afficheTickets($result);
	}

	public function afficherTicketsUrgent()
	{
		$result = $this->modele->getTicketsEtat(2);
		$this->vue->afficheTickets($result);
	}

	public function afficherTicketsEnAttente()
	{
		$result = $this->modele->getTicketsEtat(3);
		$this->vue->afficheTickets($result);
	}


    public function afficheTicket($idTicket)
    {
        $ticket = $this->modele->getTicket($idTicket);
        $infoClient = $this->modele->getInfoClient($idTicket);
        $infoTech = $this->modele->getInfoTech($idTicket);
        $techniciens = $this->modele->getAllTechniciens();
        $this->vue->afficheTicket($ticket, $infoClient, $infoTech, $techniciens);
    }

	public function assignerTicket($idTicket)
	{
        if (isset($_POST['idTechnicien'])) {
            if ($this->modele->assignerTicket($idTicket, addslashes(strip_tags($_POST['idTechnicien'])))) {
                $this->vue->messageVue("Ticket assigné avec succès !");
            } else
                $this->vue->messageVue("Le ticket n'a pas pu être assigné !");

            header('Location: /admin/ticket/'.$idTicket);
		}
	}

	public function supprimerTicket($idTicket)
	{
		if($this->modele->supprimerTicket($idTicket)) {
		    $this->vue->messageVue("Ticket supprimé avec succès !");
        } else
            $this->vue->messageVue("Le ticket n'a pas pu être supprimé !");

        header('Location: /admin/ticket/'.$idTicket);
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
		if($this->modele->supprimerTechnicien($idTechnicien)) {
		    $this->vue->messageVue("Technicien supprimer avec succès !");
        } else
            $this->vue->messageVue("Ce technicien ne peut pas être supprimé");
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
				'hashMdp' => password_hash("bienvenue", PASSWORD_DEFAULT),
				'telephone' => addslashes(strip_tags($_POST['tel'])),
				'emailFacturation' => addslashes(strip_tags($_POST['eFacturation']))
			];
			try {
				$this->verifTableauValeurNull($result);

                if($this->modele->nouveauTechnicien($result)) {
                    $this->vue->messageVue("Technicien créer avec succès !");
                } else
                    $this->vue->messageVue("Le tehcnicien n'a pas pu être créé !");
			} catch (Exception $e) {
				$e->getMessage();
			}
		} else {
			$this->vue->nouveauTechnicien();
		}
	}
}
