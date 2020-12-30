<?php
require_once 'cont_admin.php';

class ModAdmin
{

    public function __construct()
    {

        $controllAdmin = new ContAdmin();

        if (isset($_SESSION['idUtil'])) {
            if (isset($url[1])) {
                $action = $url[1];
                switch ($action) {
                    case 'menu':
                        $controllAdmin->menu();
                        break;
                    case 'listTickets':
                        $controllAdmin->listTickets();
                        break;
                    case 'printTicket':
                        $controllAdmin->printTicket();
                        break;
                    case 'deleteTicket':
                        $controllAdmin->deleteTicket();
                        break;
                    case 'gestionTechnicien':
                        $controllAdmin->gestionTechnicien();
                        break;
                    case 'deleteTechnicien':
                        $controllAdmin->gestionTechnicien();
                        break;
                    case 'newPseudo':
                        $controllAdmin->newPseudo();
                        break;
                    case 'newPass':
                        $controllAdmin->newPass();
                        break;
                    case 'stat':
                        $controllAdmin->stat();
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
