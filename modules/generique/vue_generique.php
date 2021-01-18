<?php

class VueGenerique {

    public function __construct() {
        //ob_start();
    }

    public function getPage() {
        ob_get_clean();
    }

    public function actionInexistante() {
        ?>
        <h3>Cette action est inexistante.</h3>
        <?php
    }

    
    public function tableauValeurVide() {
        ?>
        <h3>Valeur vide dans une case du formulaire.</h3>
        <?php
    }

}

?>