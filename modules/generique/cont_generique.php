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

    public function verifTableauValeurNull ($tab) {
        foreach ($tab as $key=>$v) {
            if (empty($v)) {
                throw new Exception("Valeur vide");
            }
        }
    }

    public function motDePasseIncorrect() {
        $this->vue->motDePasseIncorrect();

    }

    public function motDePasseNonIdentique() {
        $this->vue->motDePasseNonIdentique();

    }

    public function loginExiste() {
        $this->vue->loginExiste();
    }

}
