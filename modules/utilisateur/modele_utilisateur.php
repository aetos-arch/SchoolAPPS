<?php

require_once 'modules/generique/modele_generique.php';


class ModeleUtilisateur extends ModeleGenerique
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProfil($idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('select nom, prenom, emailFacturation, telephone from utilisateurs where idUtilisateur= ?');
            $req->execute(array($idUtilisateur));
            $result = $req->fetch();
            return $result;
        } catch (PDOException $e) {
        }
    }

	public function getCommande($idCommande)
	{
		try {
			$req = Connexion::$bdd->prepare('SELECT * FROM commandes c INNER JOIN produitsCommandes p ON c.idCommandes=p.idCommandes WHERE c.idCommandes= ?');
			$req->execute(array($idCommande));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}


    public function getCommandes($idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT * FROM commandes c WHERE c.idUtilisateur= ?
                                            order by c.dateAchat DESC');
            $req->execute(array($idUtilisateur));
            return $req->fetchAll();
        } catch (PDOException $e) {
        }
    }
    public function getDernieresCommandes($idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT * FROM commandes c WHERE c.idUtilisateur= ?
                                            order by c.dateAchat DESC LIMIT 3');
            $req->execute(array($idUtilisateur));
            return $req->fetchAll();
        } catch (PDOException $e) {
        }
    }

    public function peutVoirChat($idTicket, $idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT count(1) FROM tickets where idTicket = ? and idUtilisateur = ?');
            $req->execute(array($idTicket, $idUtilisateur));
            return $req->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
        }
    }

    public function envoyerMessage($result)
    {

        try {
            $req = Connexion::$bdd->prepare('INSERT INTO message (message, idTicket, idAuteur) VALUES(?, ?, ?)');
            $req->execute(array($result['message'],  $result['idTicket'], $result['idAuteur']));
        } catch (PDOException $e) {
        }
    }

    public function getMessages($idTicket)
    {

        try {
            $req = Connexion::$bdd->prepare('SELECT nom, prenom, message, dateMsg  FROM message inner join utilisateurs on idAuteur = idUtilisateur WHERE idTicket = ? ORDER BY dateMsg DESC');
            $req->execute(array($idTicket));
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function getTicket($idTicket)
    {
        try {
            $req = Connexion::$bdd->prepare('select t.*, e.etat from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat where idTicket = ?');
            $req->execute(array($idTicket));
            $result = $req->fetch();
            return $result;
        } catch (PDOException $e) {
        }
    }


    public function getInfoTech($idTicket)
    {
        try {
            $req = Connexion::$bdd->prepare('
            select  
                  u.nom
                , u.prenom
                , u.emailFacturation
                , u.telephone 
            from utilisateurs u 
                inner join tickets t 
                    on t.idTechnicien = u.idUtilisateur 
            where idTicket = ?');
            $req->execute(array($idTicket));
            $result = $req->fetch();
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function getTickets($idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('select t.*, e.etat from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat where idUtilisateur=?');
            $req->execute(array($idUtilisateur));
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function getNombreTicketsEtat($idEtat)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT * FROM tickets WHERE idEtat =?');
            $req->execute(array($idEtat));
            $nb = $req->rowCount();
            return $nb;
        } catch (PDOException $e) {
        }
    }

    public function getNombreTicketsParEtat($idTechnicien)
    {
        try {
            $req = Connexion::$bdd->prepare('select 
                                                      e.etat
                                                    , COUNT(idTicket) as nbr 
                                                from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat
                                                where idUtilisateur = ? group by e.etat');
            $req->execute(array($idTechnicien));
            return $req->fetchAll();
        } catch (PDOException $e) {
        }
    }

    public function creerTicket($result)
    {
        try {
            $req = Connexion::$bdd->prepare('INSERT INTO tickets (intitule, explication, dateCreation, idEtat, idUtilisateur, idProduit) VALUES(?, ?, NOW(), ?, ?, ?)');
            return $req->execute(array($result['intitule'], $result['explication'],  3, $result['idUtilisateur'],  $result['idProduit']));
        } catch (PDOException $e) {
        }
    }

    public function loginExiste($nouveauLogin)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT login FROM utilisateurs WHERE login = ?');
            $req->execute(array($nouveauLogin));
            $nb = $req->rowCount();
            return $nb;
        } catch (PDOException $e) {
        }
    }

    public function setLogin($idUtilisateur, $nouveauLogin)
    {
        try {
            $req = Connexion::$bdd->prepare('UPDATE utilisateurs set login = ? WHERE idUtilisateur= ?');
            $req->execute(array($nouveauLogin, $idUtilisateur));
        } catch (PDOException $e) {
        }
    }

    public function donnerAvis($result)
    {
        try {
            $req = Connexion::$bdd->prepare('insert into avis (idUtilisateur, idProduit, titre, commentaire, note) values(?, ?, ?, ?, ?)');
            $req->execute(array($result['idUtilisateur'], $result['idProduit'],  $result['titre'], $result['commentaire'],  $result['note']));
        } catch (PDOException $e) {
        }
    }

    public function avisExiste($idUtilisateur, $idProduit)
    {
        try {
            $req = Connexion::$bdd->prepare('select idUtilisateur from avis where idUtilisateur = ? and idProduit = ?');
            $req->execute(array($idUtilisateur, $idProduit));
            $nb = $req->rowCount();
            return $nb;
        } catch (PDOException $e) {
        }
    }

    public function supprimerAvis($idAvis)
    {
        try {
            $req = Connexion::$bdd->prepare('delete from avis where idAvis = ?');
            $req->execute(array($idAvis));
        } catch (PDOException $e) {
        }
    }

    public function getPass($idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('select hashMdp from utilisateurs where idUtilisateur=?');
            $req->execute(array($idUtilisateur));
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function setPass($hashMdp, $idUtilisateur)
    {
        try {
            $req = Connexion::$bdd->prepare('update utilisateurs set hashMdp = ? where idUtilisateur= ?');
            $req->execute(array($hashMdp, $idUtilisateur));
        } catch (PDOException $e) {
        }
    }

    public function getAllAvisProduit($idProduit)
    {
        try {
            $req = Connexion::$bdd->prepare('select a.*, u.login from avis a inner join utilisateurs u on a.idUtilisateur = u.idUtilisateur where idProduit=?');
            $req->execute(array($idProduit));
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }
}
