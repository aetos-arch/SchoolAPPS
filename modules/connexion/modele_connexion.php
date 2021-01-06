<?php

require_once 'config/connexion.php';

class ModeleConnexion extends Connexion{

    function connexion($pseudo,$mdp){
        $id = '';
        $selectPreparee =Connexion::$bdd->prepare('SELECT idUtilisateur,login,hashMdp FROM Utilisateurs 
            WHERE login=:pseudo AND hashMdp=:mdp');
        $reponse = array(':pseudo' => $pseudo,':mdp' => $mdp);
        $selectPreparee->execute($reponse);
        $req = $selectPreparee->fetchAll();

        if ($req!=NULL) {
            $_SESSION['idUtil']=$req[0]['idUtilisateur'];
            $_SESSION['login'] = $pseudo;
        }else{
            echo "<br>L'identifiant ou le mot de passe que vous avez saisi est erroné, veuillez recommencer s'il vous plait.";
        }

    }

    function deconnexion(){
        session_unset();
    }

    function inscription($login, $nom, $prenom, $mdp, $eFacturation, $eLivraison, $tel, $dateNaiss){
        $selectPreparee =Connexion::$bdd->prepare('
            INSERT INTO utilisateurs 
                (login, nom, prenom, hashMdp, emailFacturation, emailLivraison,
                 telephone, dateNaissance, idTypeUtilisateur)
            VALUES (:login, :nom, :prenom, :mdp, :eFacturation, :eLivraison, :tel, :dateNaiss, "1")');
        $reponse = array(':login' => $login, ':nom' => $nom, ':prenom' => $prenom, ':mdp' => $mdp,
            ':eFacturation' => $eFacturation, ':eLivraison' => $eLivraison, ':tel' => $tel, ':dateNaiss' => $dateNaiss);
        $selectPreparee->execute($reponse);
        $req = $selectPreparee->fetchAll();

        $_SESSION['idUtil']=$req[0]['idUtilisateur'];
        $_SESSION['login'] = $login;
    }

    public function loginExiste($newPseudo)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT login FROM utilisateurs WHERE login = ?');
            $req->execute(array($newPseudo));
            $nb = $req->rowCount();
            return $nb;
        } catch (PDOException $e) {
        }
    }

    public function verifInscription($login)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT login FROM utilisateurs WHERE login =:login');
            $req->execute(array(':login' => $login));
            $nb = $req->rowCount();
            if ($nb==1){
                echo '<main>Votre inscription a bien été prise en compte.</main>';
            }else{
                echo '<main>Il y a eu une erreur dans l\'inscription, veuillez recommencer.</main>';
            }
            return $nb;
        } catch (PDOException $e) {
        }
    }

}
