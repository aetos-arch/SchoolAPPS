<?php

require_once 'modules/generique/mod_generique.php';

class ModUtilisateur extends ModGenerique
{

	public function __construct($url)
	{
		$controllUtilisateur = new ContUtilisateur();

		//if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 3) {
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
					case 'tickets':
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
    $modUtilisateur = new ModUtilisateur((isset($url)) ? $url : null);
?>