<?php

class ModeleConnexion extends Connexion{

    function connexion($id,$mdp){
        $selectPreparee =Connexion::$bdd->prepare('SELECT idUtilisateur,hashMdp FROM Utilisateurs WHERE idUtilisateur=:id AND hashMdp=:mdp');
        $reponse = array(':id' => $id,':mdp' => $mdp);
        $selectPreparee->execute($reponse);
        $req = $selectPreparee->fetchAll();

        if ($req!=NULL) {
            $_SESSION['login'] = $id;
        }else{
            echo "<br>L'identifiant ou le mot de passe que vous avez saisi est erroné, veuillez recommencer s'il vous plait.";
        }

    }

    function deconnexion(){
        session_unset();
        //session_destroy();
    }

    function inscription($identifiant){
        $selectPreparee =Connexion::$bdd->prepare('SELECT idUtilisateur FROM Utilisateurs WHERE idUtilisateur=:id');
        $reponse = array(':id' => $identifiant);
        $selectPreparee->execute($reponse);
        $req = $selectPreparee->fetchAll();
        $selectPreparee =Connexion::$bdd->query('INSERT INTO Utilisateurs (idUtilisateur, hashMdp) VALUES (serial, \''.$mdp.'\')');
        $req = $selectPreparee->fetchAll();
    }
}
