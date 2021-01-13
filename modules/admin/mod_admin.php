<?php
require_once 'cont_admin.php';

class ModAdmin
{
    public function __construct()
    {

        $controllAdmin = new ContAdmin();

		if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 1) {
            if (isset($url[1])) {
                $action = $url[1];
                switch ($action) {
                    case 'menu':
                        $controllAdmin->menu();
                        break;
                    case 'tickets':
                        $controllAdmin->afficherTickets();
                        break;
                    case 'ticket':
                        $controllAdmin->afficherTicket();
                        break;
                    case 'supprimerTicket':
                        $controllAdmin->supprimerTicket();
                        break;
                        /*  case 'discussion':
                        $controllAdmin->discussion();
                        break; */
                    case 'gestionTechnicien':
                        $controllAdmin->gestionTechnicien();
                        break;
                        // case 'supprimerTechnicien':
                        //    $controllAdmin->supprimerTechnicien();
                        //    break;
                    case 'nouveauLogin':
                        $controllAdmin->nouveauLogin();
                        break;
                    case 'nouveauMotDePasse':
                        $controllAdmin->nouveauMotDePasse();
                        break;
                    case 'statistique':
                        $controllAdmin->statistique();
                        break;
                    case 'assignerTicket':
                        $controllAdmin->assignerTicket();
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

?>

<?php
    $modAdmin = new ModAdmin();
?>