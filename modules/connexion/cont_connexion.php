<?php

require_once 'modules/generique/cont_generique.php';
require_once "modele_connexion.php";
require_once "vue_connexion.php";

class ContConnexion extends ContGenerique
{

    function __construct()
    {
        parent::__construct(new ModeleConnexion(), new VueConnexion());
    }

    function connexion()
    {
        $requete = $this->modele->connexion(addslashes(strip_tags($_POST['login'])));
        if ($requete != NULL) {
            //Vérification du mot de passe :
            if (password_verify(addslashes(strip_tags($_POST['mdp'])), $requete[0]['hashMdp'])) {
                $_SESSION['idUtil'] = $requete[0]['idUtilisateur'];
                $_SESSION['login'] = $requete[0]['login'];
                $_SESSION['idTypeUtilisateur'] = $requete[0]['idTypeUtilisateur'];
                $this->vue->affichageConnexionReussie();
            } else {
                $this->vue->IDMDPErrone();
            }
        } else {
            $this->vue->IDMDPErrone();
        }
    }

    function popConnexionInscription()
    {
        $this->vue->popConnexionInscription();
    }

    function popConnexion()
    {
        $this->vue->popConnexion();
    }

    function popInscription()
    {
        $this->vue->popInscription();
    }

    function deconnexion()
    {
        session_unset();
        session_destroy();
        $this->vue->affichageDeconnexion();
    }

    function inscription()
    {
        // si login existe pas
        if ($this->modele->loginExiste(addslashes(strip_tags($_POST['login']))) == 0) {
            $this->modele->inscription(
                addslashes(strip_tags($_POST['login'])),
                addslashes(strip_tags($_POST['nom'])),
                addslashes(strip_tags($_POST['prenom'])),
                addslashes(strip_tags($_POST['mdp'])),
                addslashes(strip_tags($_POST['eFacturation'])),
                addslashes(strip_tags($_POST['eLivraison'])),
                addslashes(strip_tags($_POST['tel'])),
                addslashes(strip_tags($_POST['dateNaissance']))
            );
            // verification bien inscrit
            $utilInscrit = $this->modele->verifInscription(addslashes(strip_tags($_POST['login'])));
            if (!empty($utilInscrit)) {
                $_SESSION['idUtil'] = $utilInscrit[0]['idUtilisateur'];
                $_SESSION['login'] = $utilInscrit[0]['login'];
                $_SESSION['idTypeUtilisateur'] = $utilInscrit[0]['idTypeUtilisateur'];
                $this->vue->affichageInscription();
            } else {
                $this->vue->erreurInscription();
            }
        } else {
            $this->vue->affichageIDUtilise();
        }
    }
}
