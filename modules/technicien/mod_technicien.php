<?php

require_once 'modules/generique/mod_generique.php';
require_once 'cont_technicien.php';

class ModTechnicien extends ModGenerique
{

	public function __construct($url)
	{
		$controllTech = new ContTechnicien();

		ob_start();
		if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 2) {
			if (isset($url[1])) {
				$action = $url[1];
				switch ($action) {
					case 'menu':
						$controllTech->menu();
						break;
					case 'profil':
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
						//case 'discussion':
						//	$controllTech->discussion();
						//	break;
					default:
						$controllTech->actionInexistante();
						break;
				}
			} else {
				$controllTech->tableauBord();
			}
			$moduleContent = ob_get_clean();

			$controllTech->accueilTechnicien($moduleContent, $url);
		} else
			echo '<h3>Aucune connexion trouvée.</h3>';
	}
}

?>

<?php
$modTechnicien = new ModTechnicien((isset($url)) ? $url : null);
?>