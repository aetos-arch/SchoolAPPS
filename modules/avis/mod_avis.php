<?php
require_once 'cont_avis.php';

class ModAvis
{

    public function __construct()
    {


        // en attendant
        $url = explode('/', $_GET['url']);
        if (isset($url[1])) {
            $action = $url[1];
            echo $url[1];
        }


        $controllAvis = new ContAvis();

        if (isset($_SESSION['idUtil'])) {
            if (isset($url[1])) {
                $action = $url[1];

                switch ($action) {
                    case 'donnerAvis':
                        $controllAvis->donnerAvis();
                        break;
                    case 'supprimerAvis':
                        $controllAvis->supprimerAvis();
                        break;
                    case 'modifierAvis':
                        $controllAvis->modifierAvis();
                        break;
                    default:
                        # code...
                        break;
                }
            }
        } else {
            // page erreur
        }
    }
}
?>

<?php
$modAvis = new ModAvis();
?>