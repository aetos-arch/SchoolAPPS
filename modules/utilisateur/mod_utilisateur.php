<?php
require_once 'cont_utilisateur.php';

class ModUser
{

	public function __construct()
	{

		$controllUser = new ContUser();

		if (isset($_SESSION['idUtil'])) {
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
		} else
			echo '<h3>Aucune connexion trouvée.</h3>';
	}
}
