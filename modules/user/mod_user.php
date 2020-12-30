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
					case 'commandes':
						$controllUser->printCommandes();
						break;
					case 'ticket':
						$controllUser->ticket();
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
