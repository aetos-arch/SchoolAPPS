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
						$controllUtilisateur->afficheTicket();
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