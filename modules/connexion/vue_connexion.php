<?php

class VueConnexion{

    public function __construct () {}

    function popConnexion(){
        echo '<main><div id="pop_connexion">
            <!-- zone de connexion -->
            
            <form action="/connexion/verifConnexion" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d\'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d\'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id=\'submit\' value=\'LOGIN\' >
                </form></div></main>';
    }

    function affichage(){

        if (isset($_SESSION['login'])){
            echo "Vous etes connecté en tant que ".$_SESSION['login']."<br>";
        }
        if (isset($_SESSION['login'])) {
            echo "<a href='School-APPS/connexion/deconnexion'>Se déconnecter</a><t>";
        }else{
            echo "<a href='connexion/popConnexion'>Se connecter</a><t>
			<a href='School-APPS/connexion/inscription'>S'inscrire</a><t>";
        }
    }

    function popInscription(){
       //TODO
    }

}
