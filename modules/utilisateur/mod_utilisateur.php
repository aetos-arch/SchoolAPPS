<?php

require_once 'modules/generique/mod_generique.php';
require_once 'cont_utilisateur.php';

class ModUtilisateur extends ModGenerique
{
	/**
	 * ModUtilisateur constructor.
	 * Ce constructeur vérifie si les actions et les paramètres pour appeler la fonction correspondante dans le controlleur
	 * @param $url
	 */
	public function __construct($url)
	{
		$controllUtilisateur = new ContUtilisateur();

		ob_start();
		// Si c'est un utlisateur et qu'il est connecté
		if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 3) {
			if (isset($url[1])) {
				$action = $url[1];
				switch ($action) {
					case 'mes-informations':
						$controllUtilisateur->profil();
						break;
					case 'changer-login':
						$controllUtilisateur->nouveauLogin();
						break;
					case 'nouveau-mot-de-passe':
						$controllUtilisateur->nouveauMotDePasse();
						break;
					case 'mes-tickets':
						$controllUtilisateur->afficheTickets();
						break;
					case 'tickets-fermes':
						$controllUtilisateur->afficherTicketsFerme();
						break;
					case 'tickets-en-cours':
						$controllUtilisateur->afficherTicketsEncours();
						break;
					case 'tickets-urgent':
						$controllUtilisateur->afficherTicketsUrgent();
						break;
					case 'tickets-en-attente':
						$controllUtilisateur->afficherTicketsEnAttente();
						break;
					case 'ticket':
						if (isset($url[2]) && is_numeric($url[2])) {
							$idTicket = addslashes(strip_tags($url[2]));
							$controllUtilisateur->afficheTicket($idTicket);
						}
						break;
					case 'nouveau-ticket':
						if (isset($url[2])) {
							$produitsDefault = addslashes(strip_tags($url[2]));
						} else {
							$produitsDefault = null;
						}
						$controllUtilisateur->nouveauTicket($produitsDefault);
						break;
					case 'mes-commandes':
						$controllUtilisateur->afficheCommandes();
						break;
					case 'commande':
						if (isset($url[2]) && is_numeric($url[2])) {
							$idTicket = addslashes(strip_tags($url[2]));
							$controllUtilisateur->afficheCommande($idTicket);
						}
						break;
					case 'mes-avis':
						$controllUtilisateur->listerAvis();
						break;
					case 'supprimer-avis':
						if (isset($url[2]) && is_numeric($url[2])) {
							$idAvis = addslashes(strip_tags($url[2]));
							$controllUtilisateur->supprimerAvis($idAvis);
						}
						break;
					case 'chat':
						if (isset($_POST['message']) && is_numeric($url[2])) {
							$controllUtilisateur->envoyerMessage($url[2], addslashes(htmlspecialchars($_POST['message'])));
						} else {
							if (isset($url[2]) && is_numeric($url[2])) {
								$controllUtilisateur->getMessages($url[2], isset($_GET['json']) && $_GET['json'] == "true");
							} else {
								$controllUtilisateur->actionInexistante();
							}
						}
						break;
					default:
						$controllUtilisateur->actionInexistante(); // action invalide
						break;
				}
			} else {
				$controllUtilisateur->tableauBord();
			}
			$moduleContent = ob_get_clean();

			$controllUtilisateur->accueilUtilisateur($moduleContent, $url);
		} else
			$controllUtilisateur->vue->pasConnecté(); // Message utilisateur non connecté et/ou non autorisé
	}
}
?>

<?php
$modUtilisateur = new ModUtilisateur((isset($url)) ? $url : null);
?>