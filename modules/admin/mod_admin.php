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
                    case 'ticket':
                        $controllAdmin->ticket();
                        break;
                    case 'gestionTechnicien':
                        $controllAdmin->gestionTechnicien();
                        break;
                    case 'newPseudo':
                        $controllAdmin->newPseudo();
                        break;
                    case 'newPass':
                        $controllAdmin->newPass();
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
