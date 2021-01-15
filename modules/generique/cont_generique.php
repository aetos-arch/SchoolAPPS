<?php

require_once "modele_generique.php";
require_once "vue_generique.php";

class ContGenerique {
    public $modele;

    public $vue;

    function __construct($modele, $vue){
        $this->modele = $modele;
        $this->vue = $vue;
    }

}
?>