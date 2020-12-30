<?php
require_once 'cont_technicien.php';

class ModTechnicien
{

	public function __construct()
	{

		$controllUser = new ContTechnicien();

		if (isset($_SESSION['idUtil'])) {
			if (isset($url[1])) {
				$action = $url[1];

				switch ($action) {
					case 'menu':
						$controllUser->menu();
						break;
					case 'newPass':
						$controllUser->newPass();
						break;
					case 'printTicket':
						$controllUser->printTicket();
						break;
					case 'listTicket':
						$controllUser->listTickets();
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
