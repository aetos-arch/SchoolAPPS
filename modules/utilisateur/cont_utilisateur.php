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

	public function accueilUtilisateur($moduleContent, $url)
	{
		$this->vue->pageAccueilUtilisateur($moduleContent, $url);
	}

	public function tableauBord()
	{
		$statsTickets = $this->modele->getNombreTicketsParEtat(($_SESSION['idUtil']));
		$profil = $this->modele->getProfil(($_SESSION['idUtil']));
		$commandes = $this->modele->getDernieresCommandes(($_SESSION['idUtil']));
		$this->vue->tableauBord($profil, $statsTickets, $commandes);
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
                        //header('Location: /technicien/nouveau-mot-de-passe');
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

	public function soumettreLogin()
	{
		if (isset($_POST['nouveauLogin']) && $_POST['nouveauLogin'] != "") {
			$nouveauLogin = addslashes(strip_tags($_POST['nouveauLogin']));
			if ($this->modele->loginExiste($nouveauLogin)) {
				$this->vue->messageVue("Vous ne pouvez pas remettre le login actuel");
			} else {
				$this->modele->setLogin($_SESSION['idUtil'], $nouveauLogin);
				$_SESSION['nomUser'] = $nouveauLogin;
				$this->vue->loginMisAjour($nouveauLogin);
			}
            //header('Location: /technicien/changer-login');
		}
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

	public function nouveauTicket($ProduitDefault)
	{
        $produits = $this->modele->getProduits();
        $this->vue->nouveauTicket($produits, $ProduitDefault);
        $this->checkNouveauTicket();
	}

	public function checkNouveauTicket() {
        if (isset($_POST['explication'])) {
            $result = [
                'explication' => addslashes(strip_tags($_POST['explication'])),
                'intitule' => addslashes(strip_tags($_POST['intitule'])),
                'idProduit' => addslashes(strip_tags($_POST['idProduit'])),
                'idUtilisateur' => $_SESSION['idUtil']
            ];
            try {
                $this->verifTableauValeurNull($result);
                if($this->modele->creerTicket($result))
                    $this->vue->messageVue("Votre ticket a bien été créé, il sera traité sous peu.");
                else
                    $this->vue->messageVue("Erreur interne, impossible de créer le ticket");
            } catch (Exception $e) {
                $e->getMessage("");
            }
        }
    }

	public function profil()
	{
		$result = $this->modele->getProfil(($_SESSION['idUtil']));
		$this->vue->afficherProfil($result);
	}

	public function afficheTickets()
	{
		$result = $this->modele->getTickets(($_SESSION['idUtil']));
		$this->vue->afficheTickets($result);
	}

    public function afficherTicketsFerme()
    {
        $result = $this->modele->getTicketsEtat(0, $_SESSION['idUtil']);
        $this->vue->afficheTickets($result);
    }

    public function afficherTicketsEnCours()
    {
        $result = $this->modele->getTicketsEtat(1, $_SESSION['idUtil']);
        $this->vue->afficheTickets($result);
    }

    public function afficherTicketsUrgent()
    {
        $result = $this->modele->getTicketsEtat(2, $_SESSION['idUtil']);
        $this->vue->afficheTickets($result);
    }

    public function afficherTicketsEnAttente()
    {
        $result = $this->modele->getTicketsEtat(3, $_SESSION['idUtil']);
        $this->vue->afficheTickets($result);
    }

	public function afficheTicket($idTicket)
	{
		$result = $this->modele->getTicket($idTicket);
		$infoTech = $this->modele->getInfoTech($idTicket);
		$this->vue->afficheTicket($result, $infoTech);
	}

	public function afficheCommandes()
	{
		$commandes = $this->modele->getCommandes($_SESSION['idUtil']);
		$this->vue->afficheCommandes($commandes);
	}

	public function afficheCommande($idCommande)
	{
		$result = $this->modele->getCommande($idCommande);
		$this->vue->afficheCommande($result);
	}

	public function donnerAvis($nomProduit)
	{
		$idProduit = $this->modele->getIdProduit($nomProduit);
		$avisExiste = $this->modele->avisExiste($_SESSION['idUtilisateur'], $idProduit);
		if ($avisExiste != 0) {
			$this->vue->messageVue("avis existe déjà");
		} else if (isset($_POST['commentaire'])) {
			$result = [
				'idUtilisateur' => $_SESSION['idUtilisateur'],
				'idProduit' => addslashes(strip_tags($idProduit)),
				'titre' => addslashes(strip_tags($_POST['titre'])),
				'commentaire' => addslashes(strip_tags($_POST['commentaire'])),
				'note' => addslashes(strip_tags($_POST['note']))
			];
			$this->modele->donnerAvis($result);
		} else {
			$this->vue->formDonnerAvis();
		}
	}

    public function listerAvis()
    {
        $data = $this->modele->getAllAvisProduit($_SESSION['idUtil']);
        $this->vue->listerAvis($data);
    }

    public function supprimerAvis($idAvis)
    {
        if($this->modele->supprimerAvis($idAvis)) {
            $this->vue->messageVue("Votre avis a été supprimé");
        } else
            $this->vue->messageVue("Votre avis n'a pas pu être supprimé");
    }

}
