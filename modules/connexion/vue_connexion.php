<?php

require_once 'modules/generique/vue_generique.php';

class VueConnexion extends VueGenerique {

    public function __construct () {}

    function popConnexion(){
        echo '<main><div id="pop_connexion">
            
            <form action="/connexion/verifConnexion" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d\'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d\'utilisateur" name="login" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

                <input type="submit" id=\'submit\' value=\'Se connecter\' >
                </form></div>
                
                <div id="pop_inscription">
                    <form action="/connexion/inscription" method="POST">
                        <h1>Inscription</h1>
                        <input type="text" placeholder="Nom d\'utilisateur*" name="login" required><br>
                        <input type="text" placeholder="Nom*" name="nom" required><br>
                        <input type="text" placeholder="Prénom*" name="prenom" required><br>
                        <input type="password" placeholder="Mot de passe*" name="mdp" required><br>
                        <input type="email" placeholder="E-mail de facturation*" name="eFacturation" required><br>
                        <input type="email" placeholder="E-mail de livraison" name="eLivraison"><br>
                        <input type="tel" placeholder="Téléphone*" name="tel" required><br>
                        <input type="date" placeholder="Date de naissance*" name="dateNaissance" required><br>
                        <input type="submit" id=\'submit\' value=\'Créer un compte\' >
                </form>
                <p>Les champs suivis d\'une étoile (*) sont obligatoires.</p>
                </div>
                </main>';
    }

    function affichage(){
        echo '<main>';
        if (isset($_SESSION['login'])){
            echo 'Vous etes connecté en tant que '.$_SESSION['login'].'<br>
            <a href="/connexion/deconnexion">Se déconnecter</a>';
        }else{
            echo '<a href="/connexion/popConnexion">Se connecter</a><t>
			<a href="/connexion/inscription">S\'inscrire</a><t>';
        }
        echo '</main>';
    }

}
