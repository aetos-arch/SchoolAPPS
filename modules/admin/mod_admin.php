<?php
require_once 'cont_admin.php';

class ModAdmin extends ModeleGenerique
{
    public function __construct($url)
    {
        $controllAdmin = new ContAdmin();

        ob_start();
        if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 1) {
            if (isset($url[1])) {
                $action = $url[1];
                switch ($action) {
                    case 'mes-informations':
                        $controllAdmin->profil();
                        break;
                    case 'nouveau-mot-de-passe':
                        $controllAdmin->nouveauMotDePasse();
                        break;
                    case 'changer-login':
                        $controllAdmin->nouveauLogin();
                        if (isset($url[2]) && $url === 'verif') {
                            $controllAdmin->soumettreLogin();
                        }
                        break;
                    case 'les-tickets':
                        $controllAdmin->afficheTickets();
                        break;
                    case 'tickets-fermes':
                        $controllAdmin->afficherTicketsFerme();
                        break;
                    case 'tickets-en-cours':
                        $controllAdmin->afficherTicketsEncours();
                        break;
                    case 'tickets-urgent':
                        $controllAdmin->afficherTicketsUrgent();
                        break;
                    case 'tickets-en-attente':
                        $controllAdmin->afficherTicketsEnAttente();
                        break;
                    case 'ticket':
                        if (isset($url[2]) && is_numeric($url[2])) {
                            $idTicket = addslashes(strip_tags($url[2]));
                            $controllAdmin->afficheTicket($idTicket);
                        }
                        break;
                    case 'supprimer-ticket':
                        if (isset($url[2]) && is_numeric($url[2])) {
                            $idTicket = addslashes(strip_tags($url[2]));
                            $controllAdmin->supprimerTicket($idTicket);
                        }
                        break;
                    case 'assigner-ticket':
                        if (isset($url[2]) && is_numeric($url[2])) {
                            $idTicket = addslashes(strip_tags($url[2]));
                            $controllAdmin->assignerTicket($idTicket);
                        }
                        break;
                    case 'liste-techniciens':
                        $controllAdmin->listeTechniciens();
                        break;
                    case 'nouveau-technicien':
                        $controllAdmin->nouveauTechnicien();
                        break;
                    case 'supprimer-technicien':
                        if (isset($url[2]) && is_numeric($url[2])) {
                            $idTechnicien = addslashes(strip_tags($url[2]));
                            $controllAdmin->supprimerTechnicien($idTechnicien);
                        }
                        break;
                    default:
                        $controllAdmin->actionInexistante();
                        break;
                }
            } else {
                $controllAdmin->tableauBord();
            }
            $moduleContent = ob_get_clean();

            $controllAdmin->accueilAdmin($moduleContent, $url);
        } else
            $controllAdmin->vue->pasConnecté();
    }
}

?>

<?php
$modAdmin = new ModAdmin((isset($url)) ? $url : null);
?>