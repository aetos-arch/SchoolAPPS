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
	

		$controllUtilisateur = new ContUtilisateur();

	//	if (isset($_SESSION['idUtil'])) {
			if (isset($url[1])) {
				$action = $url[1];

				switch ($action) {
					case 'menu':
						$controllUtilisateur->menu();
						break;
					case 'nouveauLogin':
						$controllUtilisateur->nouveauLogin();
						break;
					case 'nouveauMotDePasse':
						$controllUtilisateur->nouveauMotDePasse();
						break;
					case 'afficheCommandes':
						$controllUtilisateur->afficheCommandes();
						break;
					case 'afficheTickets':
						$controllUtilisateur->afficheTickets();
						break;
					case 'commandes':
						$controllUtilisateur->afficheCommandes();
						break;
					case 'nouveauTicket':
						$controllUtilisateur->nouveauTicket();
						break;
					case 'ticket':
						$controllUtilisateur->afficheTicket();
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