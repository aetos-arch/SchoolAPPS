<?php
require_once 'modules/generique/mod_generique.php';
require_once 'cont_avis.php';

class ModAvis extends ModGenerique
{

    public function __construct($url)
    {

        $controllAvis = new ContAvis();
        
       // if (isset($_SESSION['idTypeUtilisateur']) && $_SESSION['idTypeUtilisateur'] == 3) {
            if (isset($url[1])) {
                $action = $url[1];
                switch ($action) {
                    case '':
                        $controllAvis->listerAvis($url[2]);
                        break;
                    case 'donnerAvis':
                        $controllAvis->donnerAvis($url[2]);
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
      //  } else {
            // page erreur
      //  }
    }
}
?>

<?php
$modAvis = new ModAvis((isset($url)) ? $url : null);
?>