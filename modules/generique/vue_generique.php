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
}

?>