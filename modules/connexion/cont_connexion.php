<?php

require_once 'modules/generique/cont_generique.php';
require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ContConnexion extends ContGenerique {

    function __construct(){
        parent::__construct(new ModeleConnexion(), new VueConnexion());
    }

    function connexion(){
        $requete = $this->modele->connexion($_POST['login']);

        if ($requete!=NULL) {
            //Vérification du mot de passe :
            if(password_verify($_POST['mdp'], $requete[0]['hashMdp'])) {
                $_SESSION['idUtil'] = $requete[0]['idUtilisateur'];
                $_SESSION['login'] = $requete[0]['login'];
                $_SESSION['idTypeUtilisateur'] = $requete[0]['idTypeUtilisateur'];
            }else{
                $this->vue->mdpErrone();
            }
        }else{
            $this->vue->IDMDPErrone();
        }
        $this->vue->affichage();
    }

    function popConnexionInscription(){
        $this->vue->popConnexionInscription();
    }

    function popConnexion(){
        $this->vue->popConnexion();
    }

    function popInscription(){
        $this->vue->popInscription();
    }

    function deconnexion(){
        session_unset();
        session_destroy();
        $this->vue->affichageDeconnexion();
    }

    function inscription(){
        if($this->modele->loginExiste($_POST['login'])==0) {
            $this->modele->inscription($_POST['login'], $_POST['nom'], $_POST['prenom'],
                $_POST['mdp'], $_POST['eFacturation'], $_POST['eLivraison'], $_POST['tel'], $_POST['dateNaissance']);
            $utilInscrit = $this->modele->verifInscription($_POST['login']);
            if (!empty($utilInscrit)){
                $_SESSION['idUtil'] = $utilInscrit[0]['idUtilisateur'];
                $_SESSION['login'] = $utilInscrit[0]['login'];
                $_SESSION['idTypeUtilisateur'] = $utilInscrit[0]['idTypeUtilisateur'];
                $this->vue->affichageInscription();
                $this->vue->affichage();
            }else{
                $this->vue->erreurInscription();
            }
        }else{
            $this->vue->affichageIDUtilisé();
        }
    }

}

?>