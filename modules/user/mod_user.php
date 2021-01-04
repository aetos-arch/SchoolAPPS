<?php
require_once 'cont_user.php';

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
					case 'newPseudo':
						$controllUser->newPseudo();
						break;
					case 'newPass':
						$controllUser->newPass();
						break;
					case 'listCommandes':
						$controllUser->listCommandes();
						break;
					case 'listTickets':
						$controllUser->listTickets();
						break;
					case 'printTicket':
						$controllUser->printTicket();
						break;
					case 'printCommande':
						$controllUser->printCommande();
						break;
					case 'newTicket':
						$controllUser->newTicket();
						break;
					case 'printTicket':
						$controllUser->printTicket();
						break;
					case 'listTicket':
						$controllUser->listTickets();
						break;
					case 'choisirDateRdv':
						$controllUser->choisirDateRdv();
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
