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

    public function pasConnecté(){
        ?>
        <section class="container content-block login-form">
            <div class="container-fluid" id="pop_connexion">
                <div class="row">
                    <h1>Vous devez être connecté pour accéder cette ressource</h1>
                    <hr>
                    <span class="login-form"></span>
                    <a class="btn btn-outline-success col-5 mx-auto" href="/connexion/popConnexion">Me connecter</a>
                </div>
            </div>
            <br>
        </section>
        <?php
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