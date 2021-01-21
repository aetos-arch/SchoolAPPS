<?php

require_once 'modules/generique/vue_generique.php';

class VueConnexion extends VueGenerique {

    public function __construct () {
        parent::__construct();
    }

    function popConnexionInscription() {
        ?>
        <section class="container content-block login-form">
            <div id="pop_connexion">
                <h1>Connexion</h1>
                <hr>
                <form class="row container-fluid" action="/connexion/connexion" method="POST">
                    <div class="col-5 form-group mx-auto">
                        <label for="login">Nom d'utilisateur</label>
                        <input name="login" type="text" class="form-control" required placeholder="Votre identifiant">
                        <label for="mdp">Mot de passe</label>
                        <input name="mdp" type="password" class="form-control" required placeholder="Votre mot de passe">
                        <input class="btn btn-success" type="submit" id="submit" value="Se connecter" >
                    </div>
                </form>
            </div>
            <br>
        </section>
        <section class="container content-block login-form">
            <div id="pop_inscription">
                <h1>Inscription</h1>
                <hr>
                <form class="row container-fluid" action="/connexion/inscription" method="POST">
                    <div class="col-5 form-group mx-auto">
                        <label for="login">Nom d'utilisateur*</label>
                        <input name="login" type="text" class="form-control" required placeholder="Nom d'utilisateur*">
                        <label for="nom">Nom*</label>
                        <input name="nom" type="text" class="form-control" required placeholder="Nom*">
                        <label for="prenom">Prénom*</label>
                        <input name="prenom" type="text" class="form-control" required placeholder="Prénom*">
                        <label for="mdp">Mot de passe</label>
                        <input name="mdp" type="password" class="form-control" required placeholder="Mot de passe*">
                        <label for="eFacturation">Adresse e-mail de facturation*</label>
                        <input name="eFacturation" type="email" class="form-control" required placeholder="E-mail de facturation*">
                        <label for="eLivraison">Adresse e-mail de livraison</label>
                        <input name="eLivraison" type="email" class="form-control" placeholder="E-mail de livraison">
                        <label for="tel">Téléphone*</label>
                        <input name="tel" type="tel" class="form-control" required placeholder="Téléphone*">
                        <label for="dateNaissance">Date de naissance*</label>
                        <input name="dateNaissance" type="date" class="form-control" required placeholder="Date de naissance*">
                        <input type="submit" id="submit" value="Créer un compte" class="btn btn-success">
                        <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
                    </div>
                </form>
            </div>
        </section>
        <?php
    }

    function popConnexion(){
        ?>
        <section class="container content-block login-form">
            <div id="pop_connexion">
                <h1>Connexion</h1>
                <hr>
                <form class="row container-fluid" action="/connexion/connexion" method="POST">
                    <div class="col-5 form-group mx-auto">
                        <label for="login">Nom d'utilisateur</label>
                        <input name="login" type="text" class="form-control" required placeholder="Votre identifiant">
                        <label for="mdp">Mot de passe</label>
                        <input name="mdp" type="password" class="form-control" required placeholder="Votre mot de passe">
                        <input class="btn btn-success" type="submit" id="submit" value="Se connecter" >
                    </div>
                </form>
            </div>
            <br>
        </section>
        <?php
    }

    function popInscription(){
        ?>
        <section class="container content-block login-form">
                <div id="pop_inscription">
                        <h1>Inscription</h1>
                        <hr>
                        <form class="row container-fluid" action="/connexion/inscription" method="POST">
                            <div class="col-5 form-group mx-auto">
                                <label for="login">Nom d'utilisateur*</label>
                                <input name="login" type="text" class="form-control" required placeholder="Nom d'utilisateur*">
                                <label for="nom">Nom*</label>
                                <input name="nom" type="text" class="form-control" required placeholder="Nom*">
                                <label for="prenom">Prénom*</label>
                                <input name="prenom" type="text" class="form-control" required placeholder="Prénom*">
                                <label for="mdp">Mot de passe</label>
                                <input name="mdp" type="password" class="form-control" required placeholder="Mot de passe*">
                                <label for="eFacturation">Adresse e-mail de facturation*</label>
                                <input name="eFacturation" type="email" class="form-control" required placeholder="E-mail de facturation*">
                                <label for="eLivraison">Adresse e-mail de livraison</label>
                                <input name="eLivraison" type="email" class="form-control" placeholder="E-mail de livraison">
                                <label for="tel">Téléphone*</label>
                                <input name="tel" type="tel" class="form-control" required placeholder="Téléphone*">
                                <label for="dateNaissance">Date de naissance*</label>
                                <input name="dateNaissance" type="date" class="form-control" required placeholder="Date de naissance*">
                                <input type="submit" id="submit" value="Créer un compte" class="btn btn-success">
                                <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
                            </div>
                        </form>
                </div>
        </section>
        <?php
    }

    function affichageConnexionReussie(){
        echo '<span class="info-utilisateur">Vous êtes connecté.e en tant que '.$_SESSION['login'].'<br>
            <a href="/connexion/deconnexion">Se déconnecter</a></span>';
    }

    function affichageInscription(){
        echo '<span class="info-utilisateur">Votre inscription a bien été prise en compte.</span>';
    }

    function erreurInscription(){
        echo '<span class="info-utilisateur">Il y a eu une erreur dans l\'inscription, veuillez recommencer.</span>';
    }

    function IDMDPErrone(){
        echo '<span class="info-utilisateur">L\'identifiant ou le mot de passe que vous avez saisi est erroné, veuillez recommencer s\'il vous plait.</span>';
    }

    function mdpErronne(){
        echo '<span class="info-utilisateur"><br>Le mot de passe que vous avez saisi est erroné, veuillez recommencer s\'il vous plait.</span>';
    }

    function affichageDeconnexion(){
        echo '<span class="info-utilisateur">Vous avez bien été déconnecté(e).<br>
            <a href="/home">Retour à la page d\'accueil</a></span>';
    }

    function affichageIDUtilise(){
        echo '<span class="info-utilisateur"><a href="/connexion/popInscription">L\'identifiant que vous avez saisi est déjà pris, veuillez recommencer avec un autre.</a></span>';
    }

}
