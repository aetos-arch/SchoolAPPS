<?php

require_once 'modules/generique/mod_generique.php';
require_once 'cont_technicien.php';

class ModTechnicien extends ModGenerique
{
	/**
	 * ModTechnicien constructor.
	 * Ce constructeur vérifie si les actions et les paramètres sont valides pour appeler la fonction correspondante dans le controlleur
	 * @param $url
	 */
	public function __construct($url)
	{
		$controllTech = new ContTechnicien();

		ob_start();
		// Si c'est un technicien et qu'il est connecté
		if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 2) {
			if (isset($url[1])) {
				$action = $url[1];
				switch ($action) {
					case 'mes-informations':
						$controllTech->profil();
						break;
					case 'nouveau-mot-de-passe':
						$controllTech->nouveauMotDePasse();
						break;
					case 'changer-login':
						$controllTech->nouveauLogin();
						if (isset($url[2]) && $url === 'verif') {
							$controllTech->soumettreLogin();
						}
						break;
					case 'tickets-fermes':
						$controllTech->afficherTicketsFerme();
						break;
					case 'tickets-en-cours':
						$controllTech->afficherTicketsEncours();
						break;
					case 'tickets-urgent':
						$controllTech->afficherTicketsUrgent();
						break;
					case 'tickets-en-attente':
						$controllTech->afficherTicketsEnAttente();
						break;
					case 'ticket':
						if (isset($url[2]) && is_numeric($url[2])) {
							$idTicket = addslashes(strip_tags($url[2]));
							$controllTech->afficheTicket($idTicket);
							if (isset($url[3]) && $url[3] === 'changer-etat') {
								$controllTech->changerEtatTicket($idTicket);
							}
						}
						break;
					case 'mes-tickets':
						$controllTech->afficheTickets();
						break;
					case 'chat':
						if (isset($_POST['message']) && is_numeric($url[2])) {
							$controllTech->envoyerMessage($url[2], addslashes(htmlspecialchars($_POST['message'])));
						} else {
							if (isset($url[2]) && is_numeric($url[2])) {
								$controllTech->getMessages($url[2], isset($_GET['json']) && $_GET['json'] == "true");
							} else {
								$controllTech->actionInexistante();
							}
						}
						break;
					default:
						$controllTech->actionInexistante(); // Action invalide
						break;
				}
			} else {
				$controllTech->tableauBord();
			}
			$moduleContent = ob_get_clean();

			$controllTech->accueilTechnicien($moduleContent, $url);
		} else
			$controllTech->vue->pasconnecté(); // Message utilisateur non connecté et/ou non autorisé
	}
}

?>

<?php
$modTechnicien = new ModTechnicien((isset($url)) ? $url : null);
?>