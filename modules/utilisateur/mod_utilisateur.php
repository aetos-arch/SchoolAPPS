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
					case 'menu':
						$controllUtilisateur->menu();
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
					case 'commandes':
						$controllUtilisateur->afficheCommandes();
						break;
					case 'nouveau-ticket':
						$controllUtilisateur->nouveauTicket();
						break;
					case 'ticket':
						if (isset($url[2])) {
							$controllUtilisateur->afficheTicket($url[2]);
						} else {
							$controllUtilisateur->actionInexistante();
						}
						break;
					case 'donner-avis':
						if (isset($url[2])) {
							$controllUtilisateur->donnerAvis($url[2]);
						} else {
							$controllUtilisateur->actionInexistante();
						}
						break;
					case 'supprimerAvis':
						$controllUtilisateur->supprimerAvis();
						break;
					case 'modifierAvis':
						$controllUtilisateur->modifierAvis();
						break;
					case 'chat':
						if (isset($_POST['message'])) {
							$controllUtilisateur->envoyerMessage($url[2], $_POST['message']);
						} else {
							if (isset($url[2])) {
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

			$controllUtilisateur->accueilUtilisateur($moduleContent);
		} else
			echo '<h3>Aucune connexion trouvée.</h3>';
	}
}
?>

<?php
$modUtilisateur = new ModUtilisateur((isset($url)) ? $url : null);
?>