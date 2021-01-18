<?php

require_once 'modules/generique/mod_generique.php';
require_once 'cont_technicien.php';

class ModTechnicien extends ModGenerique
{

	public function __construct($url)
	{
		$controllUser = new ContTechnicien();

		ob_start();
		if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 2) {
			if (isset($url[1])) {
				$action = $url[1];
				switch ($action) {
					case 'menu':
						$controllUser->menu();
						break;
					case 'tableau de board':
						$controllUser->nouveauMotDePasse();
						break;
					case 'changer login':
						$controllUser->nouveauLogin();
						break;
					case 'nouveauMotDePasse':
						$controllUser->nouveauMotDePasse();
						break;
					case 'ticket':
						$controllUser->afficheTicket();
						break;
					case 'tickets':
						$controllUser->afficheTickets();
						break;
						//case 'changerEtat':
						//	$controllUser->changerEtat();
						//	break;
						//case 'discussion':
						//	$controllUser->discussion();
						//	break;
					default:
						$controllUser->actionInexistante();
						break;
				}
			} else {
				$controllUser->tableauBord();
			}
			$moduleContent = ob_get_clean();

			$controllUser->accueilTechnicien($moduleContent);
		} else
			echo '<h3>Aucune connexion trouvée.</h3>';
	}
}

?>

<?php
$modTechnicien = new ModTechnicien((isset($url)) ? $url : null);
?>