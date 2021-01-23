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

    /**
     * @brief Cette fonction vérifie si un tableau n'a aucune valeur null afin de faire les insertions dans la BDD
     * @param tab is an integer
     */
    public function verifTableauValeurNull($tab) {
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
