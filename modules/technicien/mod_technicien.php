<?php
require_once 'cont_technicien.php';

class ModTechnicien extends ModGenerique
{

	public function __construct()
	{

		$controllUser = new ContTechnicien();

		if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 2) {
			if (isset($url[1])) {
				$action = $url[1];

				switch ($action) {
					case 'menu':
						$controllUser->menu();
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
						# code...
						break;
				}
			}
		} else
			echo '<h3>Aucune connexion trouvée.</h3>';
	}
}

?>

<?php
$modTechnicien = new ModTechnicien($url);
?>