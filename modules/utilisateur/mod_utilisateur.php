<?php
require_once 'cont_utilisateur.php';

class ModUtilisateur
{

	public function __construct()
	{


		// en attendant
		$url = explode('/', $_GET['url']);
		if (isset($url[1])) {
			$action = $url[1];
			echo $url[1];
		}
	

		$controllUser = new ContUtilisateur();

	//	if (isset($_SESSION['idUtil'])) {
			if (isset($url[1])) {
				$action = $url[1];

				switch ($action) {
					case 'menu':
						$controllUser->menu();
						break;
					case 'nouveauLogin':
						$controllUser->nouveauLogin();
						break;
					case 'nouveauMotDePasse':
						$controllUser->nouveauMotDePasse();
						break;
					case 'afficheCommandes':
						$controllUser->afficheCommandes();
						break;
					case 'afficheTickets':
						$controllUser->afficheTickets();
						break;
					case 'commandes':
						$controllUser->afficheCommandes();
						break;
					case 'nouveauTicket':
						$controllUser->nouveauTicket();
						break;
					case 'ticket':
						$controllUser->afficheTicket();
						break;
					default:
						# code...
						break;
				}
			}
	//	} else
		//	echo '<h3>Aucune connexion trouvée.</h3>';
	}
}
?>

<?php
    $modUtilisateur = new ModUtilisateur();
?>