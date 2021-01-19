<?php

class VueGenerique {

    public function __construct() {
        //ob_start();
    }

    public function getPage() {
        ob_get_clean();
    }

    // erreur 404
    public function actionInexistante() {
        ?>
        <h3>Cette action est inexistante.</h3>
        <?php
    }

    public function messageVue($msg)
    {
        ?> <span class="alert-warning"><?= $msg ?></span><?php
    }

    public function motDePasseIncorrect() {
        ?>
        <h3>Mot de passe incorrect.</h3>
        <?php
    }

    public function motDePasseNonIdentique() {
        ?>
        <h3>Les deux mots de passe saisies ne sont pas identiques...</h3>
        <?php
    }

    public function loginExiste() {
        ?>
        <h3>Le login que vous avez saisie existe malheuresement déjà :(...</h3>
        <?php
    }

}

?>