<?php
	require_once 'cont_majUser.php';

	class ModUser{
		
		public function __construct() {

			$controlleurUser = new ContUser();

			if (isset($_SESSION['idUtil'])) {

				if (isset($url[1])) {

					$action = $url[1];

						switch ($action) {
							case 'menu':
								$controlleurUser->menu();
								break;

							case 'newPseudo':
								$controlleurUser->newPseudo();
								break;
							
							case 'newPass':
								$controlleurUser->newPass();
								break;
							case 'commandes':
								$controlleurUser->printCommandes();
								break;
							case 'ticket':
								$controlleurUser->ticket();
								break;
							default:
								# code...
								break;
						}
				}
			}
			else
					echo '<h3>Aucune connexion trouvée.</h3>';
		}

	}
	
?>