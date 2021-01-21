<?php

require_once 'modules/generique/mod_generique.php';
require_once 'cont_utilisateur.php';

class ModUtilisateur extends ModGenerique
{

	public function __construct($url)
	{
		$controllUtilisateur = new ContUtilisateur();

		ob_start();
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
						$controllUtilisateur->affichesAvis();
						break;
					case 'donner-avis':
						if (isset($url[2])) {
							$controllUtilisateur->donnerAvis($url[2]);
						} else {
							$controllUtilisateur->actionInexistante();
						}
						break;
					case 'supprimer-avis':
						$controllUtilisateur->supprimerAvis();
						break;
					case 'modifier-avis':
						$controllUtilisateur->modifierAvis();
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
						$controllUtilisateur->actionInexistante();
						break;
				}
			} else {
				$controllUtilisateur->tableauBord();
			}
			$moduleContent = ob_get_clean();

			$controllUtilisateur->accueilUtilisateur($moduleContent, $url);
		} else
			$controllUtilisateur->vue->pasConnecté();
	}
}
?>

<?php
$modUtilisateur = new ModUtilisateur((isset($url)) ? $url : null);
?>