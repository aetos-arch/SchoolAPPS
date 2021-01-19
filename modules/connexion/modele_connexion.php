<?php

require_once 'config/connexion.php';

class ModeleConnexion extends Connexion{

    function connexion($pseudo,$mdp){
        $selectPreparee =Connexion::$bdd->prepare('SELECT idUtilisateur,login,hashMdp,idTypeUtilisateur FROM Utilisateurs 
            WHERE login=:pseudo');
        $reponse = array(':pseudo' => $pseudo);
        $selectPreparee->execute($reponse);
        $req = $selectPreparee->fetchAll();

        if ($req!=NULL) {
            //Vérification du mot de passe :
            if(password_verify($mdp, $req[0]['hashMdp'])) {
                $_SESSION['idUtil'] = $req[0]['idUtilisateur'];
                $_SESSION['login'] = $req[0]['login'];
                $_SESSION['idTypeUtilisateur'] = $req[0]['idTypeUtilisateur'];
            }else{
                echo "<br>Le mot de passe que vous avez saisi est erroné, veuillez recommencer s'il vous plait.";
            }
        }else{
            echo "<br>L'identifiant ou le mot de passe que vous avez saisi est erroné, veuillez recommencer s'il vous plait.";
        }

    }

    function deconnexion(){
        session_unset();
        session_destroy();
    }

    function inscription($login, $nom, $prenom, $mdp, $eFacturation, $eLivraison, $tel, $dateNaiss){
        $selectPrepareeInsert =Connexion::$bdd->prepare('
            INSERT INTO utilisateurs 
                (login, nom, prenom, hashMdp, emailFacturation, emailLivraison,
                 telephone, dateNaissance, idTypeUtilisateur)
            VALUES (:login, :nom, :prenom, :mdp, :eFacturation, :eLivraison, :tel, :dateNaiss, "3")');
        $reponse = array(':login' => $login, ':nom' => $nom, ':prenom' => $prenom, ':mdp' => password_hash($mdp, PASSWORD_DEFAULT),
            ':eFacturation' => $eFacturation, ':eLivraison' => $eLivraison, ':tel' => $tel, ':dateNaiss' => $dateNaiss);
        $selectPrepareeInsert->execute($reponse);
        $req = $selectPrepareeInsert->fetchAll();

        //Vérification de l'inscription :
        $selectPrepareeVerif = Connexion::$bdd->prepare('
            SELECT idUtilisateur,login,idTypeUtilisateur FROM utilisateurs WHERE login =:login');
        $selectPrepareeVerif->execute(array(':login' => $login));
        $req = $selectPrepareeVerif->fetchAll();
        if ($req!=NULL) {
            $_SESSION['idUtil'] = $req[0]['idUtilisateur'];
            $_SESSION['login'] = $req[0]['login'];
            $_SESSION['idTypeUtilisateur'] = $req[0]['idTypeUtilisateur'];
            echo '<main>Votre inscription a bien été prise en compte.</main>';
        }else{
            echo '<main>Il y a eu une erreur dans l\'inscription, veuillez recommencer.</main>';
        }
    }

    public function loginExiste($newPseudo){
        try {
            $req = Connexion::$bdd->prepare('SELECT login FROM utilisateurs WHERE login = ?');
            $req->execute(array($newPseudo));
            $nb = $req->rowCount();
        } catch (PDOException $e) {
        }
        return $nb;
    }

    public function verifInscription($login)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT login FROM utilisateurs WHERE login =:login');
            $req->execute(array(':login' => $login));
            $nb = $req->rowCount();
        } catch (PDOException $e) {
        }
        return $nb;
    }

}
