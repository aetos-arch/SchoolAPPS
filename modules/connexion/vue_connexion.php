<?php

require_once 'modules/generique/vue_generique.php';

class VueConnexion extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    function popConnexionInscription()
    {
?>
        <section class="container content-block login-form">
            <div id="pop_connexion">
                <h1>Connexion</h1>
                <hr>
                <form class="row container-fluid" action="/connexion/connexion" method="POST">
                    <div class="col-lg-6 form-group mx-auto">
                        <div class="form-content">
                            <label for="login">Nom d'utilisateur</label>
                            <input name="login" type="text" class="form-control" required placeholder="Votre identifiant">
                        </div>
                        <div class="form-content">
                            <label for="mdp">Mot de passe</label>
                            <input name="mdp" type="password" class="form-control" required placeholder="Votre mot de passe"></div>
                        <div class="form-content">
                        <input class="btn btn-success" type="submit" id="submit" value="Se connecter">
                        </div>
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
                    <div class="col-lg-6 form-group mx-auto">
                        <div class="form-content">
                            <label for="login">Nom d'utilisateur *</label>
                            <input name="login" type="text" class="form-control" required placeholder="Nom d'utilisateur">
                        </div>
                        <div class="form-content">
                            <label for="nom">Nom *</label>
                            <input name="nom" type="text" class="form-control" required placeholder="Nom">
                        </div>
                        <div class="form-content">
                            <label for="prenom">Prénom *</label>
                            <input name="prenom" type="text" class="form-control" required placeholder="Prénom">
                        </div>
                        <div class="form-content">

                        </div>
                        <div class="form-content">
                            <label for="mdp">Mot de passe *</label>
                            <input name="mdp" type="password" class="form-control" required placeholder="Mot de passe">
                        </div>
                        <div class="form-content">
                            <label for="eFacturation">Adresse e-mail de facturation *</label>
                            <input name="eFacturation" type="email" class="form-control" required placeholder="E-mail de facturation">
                        </div>
                        <div class="form-content">
                            <label for="eLivraison">Adresse e-mail de livraison</label>
                            <input name="eLivraison" type="email" class="form-control" placeholder="E-mail de livraison">
                        </div>
                        <div class="form-content">
                            <label for="tel">Téléphone *</label>
                            <input name="tel" type="tel" class="form-control" required placeholder="Téléphone">
                        </div>
                        <div class="form-content">
                            <label for="dateNaissance">Date de naissance *</label>
                            <input name="dateNaissance" type="date" class="form-control" required placeholder="Date de naissance">
                        </div>
                        <div class="form-content">
                            <input type="submit" id="submit" value="Créer un compte" class="btn btn-success">
                            <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php
    }

    function popConnexion()
    {
    ?>
        <section class="container content-block login-form">
            <div id="pop_connexion">
                <h1>Connexion</h1>
                <hr>
                <form class="row container-fluid" action="/connexion/connexion" method="POST">
                    <div class="col-lg-6 form-group mx-auto">
                        <div class="form-content">
                            <label for="login">Nom d'utilisateur</label>
                            <input name="login" type="text" class="form-control" required placeholder="Votre identifiant">
                        </div>
                        <div class="form-content">
                            <label for="mdp">Mot de passe</label>
                            <input name="mdp" type="password" class="form-control" required placeholder="Votre mot de passe"></div>
                        <div class="form-content">
                            <input class="btn btn-success" type="submit" id="submit" value="Se connecter">
                        </div>
                    </div>
                </form>
            </div>
            <br>
        </section>
    <?php
    }

    function popInscription()
    {
    ?>
        <section class="container content-block login-form">
            <div id="pop_inscription">
                <h1>Inscription</h1>
                <hr>
                <form class="row container-fluid" action="/connexion/inscription" method="POST">
                    <div class="col-lg-6 form-group mx-auto">
                        <div class="form-content">
                            <label for="login">Nom d'utilisateur *</label>
                            <input name="login" type="text" class="form-control" required placeholder="Nom d'utilisateur">
                        </div>
                        <div class="form-content">
                            <label for="nom">Nom *</label>
                            <input name="nom" type="text" class="form-control" required placeholder="Nom">
                        </div>
                        <div class="form-content">
                            <label for="prenom">Prénom *</label>
                            <input name="prenom" type="text" class="form-control" required placeholder="Prénom">
                        </div>
                        <div class="form-content">

                        </div>
                        <div class="form-content">
                            <label for="mdp">Mot de passe *</label>
                            <input name="mdp" type="password" class="form-control" required placeholder="Mot de passe">
                        </div>
                        <div class="form-content">
                            <label for="eFacturation">Adresse e-mail de facturation *</label>
                            <input name="eFacturation" type="email" class="form-control" required placeholder="E-mail de facturation">
                        </div>
                        <div class="form-content">
                            <label for="eLivraison">Adresse e-mail de livraison</label>
                            <input name="eLivraison" type="email" class="form-control" placeholder="E-mail de livraison">
                        </div>
                        <div class="form-content">
                            <label for="tel">Téléphone *</label>
                            <input name="tel" type="tel" class="form-control" required placeholder="Téléphone">
                        </div>
                        <div class="form-content">
                            <label for="dateNaissance">Date de naissance *</label>
                            <input name="dateNaissance" type="date" class="form-control" required placeholder="Date de naissance">
                        </div>
                        <div class="form-content">
                            <input type="submit" id="submit" value="Créer un compte" class="btn btn-success">
                            <p>Les champs suivis d'une étoile (*) sont obligatoires.</p>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php
    }

    function affichageConnexionReussie()
    {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Bonjour, vous êtes connecté(e) en tant que <b><i><?= $_SESSION['login'] ?></i></b></h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <?php if (isset($_SESSION['idTypeUtilisateur'])) {
                        switch ($_SESSION['idTypeUtilisateur']) {
                            case 1:
                                echo '<a class="big-info btn btn-outline-success" href="/admin">Mon espace Administrateur</a>';
                                break;
                            case 2:
                                echo '<a class="big-info btn btn-outline-success" href="/technicien">Mon espace Technicien</a>';
                                break;
                            case 3:
                                echo '<a class="big-info btn btn-outline-success" href="/utilisateur">Mon espace Utilisateur</a>';
                                break;
                            default:
                                break;
                        }
                    } ?>
            </div>
        </div>
    <?php
    }

    function affichageInscription()
    {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Bienvenue <b><i><?= $_SESSION['login'] ?></i></b>, votre inscription a bien été prise en compte.</h1>
                    <h1>Vous êtes maintenant connecté.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/utilisateur">Espace utilisateur</a>
                </h1>
            </div>
        </div>
    <?php
    }

    function erreurInscription()
    {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Nous sommes désolés mais il semblerait qu'il y ait eu une erreur dans l'inscription,<br>
                        veuillez recommencer s'il vous plaît.<br>
                        Si le problème persiste, veuillez nous envoyer un e-mail à <u>contact@schoolaps.studio</u>.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/connexion/popInscription">Inscription</a>
                </h1>
            </div>
        </div>
    <?php
    }

    function IDMDPErrone()
    {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>L'identifiant ou le mot de passe que vous avez saisi est erroné, veuillez recommencer s'il vous plait.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/connexion/popConnexion">Connexion</a>
                </h1>
            </div>
        </div>
    <?php
    }

    function affichageDeconnexion()
    {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>Vous avez bien été déconnecté(e).</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/connexion/popConnexion">Page de connexion</a>
                </h1>
            </div>
        </div>
    <?php
    }

    function affichageIDUtilise()
    {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>L'identifiant que vous avez saisi est déjà pris, veuillez recommencer avec un autre.</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                    <a class="big-info btn btn-outline-success" href="/connexion/popInscription">Inscription</a>
                </h1>
            </div>
        </div>
<?php
    }
}
