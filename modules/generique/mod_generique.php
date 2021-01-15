<?php


require_once "cont_generique.php";
require_once "modele_generique.php";
require_once "vue_generique.php";

class ModGenerique{

    protected static $url;

    function __construct(){

        $controleur = new ContGenerique(new ModeleGenerique(), new VueGenerique());
        $action='';

    }

}
?>
<?php
    $modConnexion = new ModGenerique();
?>