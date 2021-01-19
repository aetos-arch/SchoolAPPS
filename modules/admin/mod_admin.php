<?php
require_once 'cont_admin.php';

class ModAdmin extends ModeleGenerique
{
    public function __construct($url)
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
                        $controllAdmin->afficherTicket($url[2]);
                        break;
                    case 'supprimer-ticket':
                        $controllAdmin->supprimerTicket();
                        break;
                        /*  case 'discussion':
                        $controllAdmin->discussion();
                        break; */
                    case 'nouveau-technicien':
                        $controllAdmin->nouveauTechnicien();
                        break;
                    case 'liste-techniciens':
                        $controllAdmin->listeTechniciens();
                        break;
                    case 'assigner-ticket':
                        $controllAdmin->assignerTicket();
                        break;
                        // case 'supprimerTechnicien':
                        //    $controllAdmin->supprimerTechnicien();
                        //    break;
                    case 'nouveau-login':
                        $controllAdmin->nouveauLogin();
                        break;
                    case 'nouveau-mdp':
                        $controllAdmin->nouveauMotDePasse();
                        break;
                    case 'statistique':
                        $controllAdmin->statistique();
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
$modAdmin = new ModAdmin((isset($url)) ? $url : null);
?>