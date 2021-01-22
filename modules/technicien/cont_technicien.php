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
    
    public function getMessages($idTicket, $isJson)
	{
		$peutVoirChat = $this->modele->peutVoirChat($idTicket, $_SESSION['idUtil']);
		if ($peutVoirChat) {
			if ($isJson) {
				$result = $this->modele->getMessages($idTicket);
				$this->vue->json($result);
				header('Content-Type: application/json');
				exit();
			} else {
				$this->vue->chat();
			}
		} else {
			$this->vue->messageVue("Pas de chat...");
		}
	}

	public function envoyerMessage($idTicket, $message)
	{
		$peutVoirChat = $this->modele->peutVoirChat($idTicket,  $_SESSION['idUtil']);
		if ($peutVoirChat == 1) {
			$result = [
				'idAuteur' => $_SESSION['idUtil'],
				'idTicket' => $idTicket,
				'message' => $message
			];
			$this->modele->envoyerMessage($result);
		} else {
			$this->vue->messageVue("Pas de chat...");
		}
	}

    public function accueilTechnicien($moduleContent, $url)
    {
        $this->vue->pageAccueilTech($moduleContent, $url);
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
                        header('Location: /technicien/nouveau-mot-de-passe');
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
            header('Location: /technicien/changer-login');
        }
    }

    public function changerEtatTicket($idTicket) {
        if (isset($_POST['nouveauEtat']) && $_POST['nouveauEtat']!= "") {
            $nouveauEtat = addslashes(strip_tags($_POST['nouveauEtat']));
            if ($this->modele->changementEtatTicket($idTicket, $nouveauEtat)) {
                $this->vue->messageVue("L'etat du ticket a été mis à jour !");
            } else {
                $this->vue->messageVue("Oups, une erreur s'est produite la mise à jour n'a pas été prise en compte");
            }
            header('Location: /technicien/ticket/'.$idTicket);
        }
    }

	public function tableauBord()
	{
        $statsTickets = $this->modele->getNombreTicketsParEtat(($_SESSION['idUtil']));
        $profil = $this->modele->getProfil(($_SESSION['idUtil']));
		$this->vue->tableauBord($profil, $statsTickets);
	}

	public function afficheTickets()
	{
		$result = $this->modele->getTickets(($_SESSION['idUtil']));
		$this->vue->afficheTickets($result);
	}

	public function afficheTicketsParEtat()
	{
		$result = $this->modele->getNombreTicketsParEtat(($_SESSION['idUtil']));
		var_dump($result);
		//$this->vue->afficheTickets($result);
	}

	public function afficheTicket($idTicket)
	{
		$ticket = $this->modele->getTicket($idTicket);
        $infoClient = $this->modele->getInfoClient($idTicket);
        $etats = $this->modele->getEtats();
		$this->vue->afficheTicket($ticket, $infoClient, $etats);
	}


}
