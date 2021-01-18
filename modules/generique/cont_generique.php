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

    function actionInexistante() {
        $this->vue->actionInexistante();
    }

    public function verifTableauPasVide ($tab) {
        foreach ($tab as $key=>$v) {
            if (empty($v)) {
                return false;
            }
        }
        return true;
    }

    function tableauValeurVide() {
        $this->vue->tableauValeurVide();
    }

}
?>