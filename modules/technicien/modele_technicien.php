<?php

require_once 'modules/generique/modele_generique.php';
//require_once 'config/connexion.php';

class ModeleTechnicien extends ModeleGenerique
{
	public function __construct()
	{
	}

	public function getTicketsEtat($idEtat, $idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idEtat = ? and idUtilisateur = ?');
			$req->execute(array($idEtat, $idUtilisateur));
			$result = $req->fetchAll();
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

    public function getInfoClient($idTicket)
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
                    on t.idUtilisateur = u.idUtilisateur 
            where idTicket = ?');
            $req->execute(array($idTicket));
            $result = $req->fetch();
            return $result;
        } catch (PDOException $e) {
        }
	}
	
	public function peutVoirChat($idTicket, $idTechnicien)
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT idTicket FROM tickets where idTicket = ? and idTechnicien = ?');
            $req->execute(array($idTicket, $idTechnicien));
            $nb = $req->rowCount();
            return $nb;
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

	public function changerEtat($idEtat, $idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('update tickets set idEtat = ? where idTicket = ?');
			$req->execute(array($idEtat, $idTicket));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getNombreTicketsEtat($idTechnicien, $idEtat)
	{
		try {
			$req = Connexion::$bdd->prepare('select idTicket from tickets where idTechnicien = ? and idEtat = ?');
			$req->execute(array($idTechnicien, $idEtat));
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
                                                where idTechnicien = ? group by e.etat');
			$req->execute(array($idTechnicien));
			return $req->fetchAll();
		} catch (PDOException $e) {
		}
	}

	public function getTickets($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('select t.*, e.etat from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat where idTechnicien=?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getEtats()
	{
		try {
			$req = Connexion::$bdd->prepare('select * from etats');
			$req->execute();
            return $req->fetchAll();
		} catch (PDOException $e) {
		}
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

	public function loginExiste($newLogin)
	{
		try {
			$req = Connexion::$bdd->prepare('select login from utilisateurs where login = ?');
			$req->execute(array($newLogin));
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

    public function changementEtatTicket($idTicket, $nouveauEtat)
    {
        try {
            $req = Connexion::$bdd->prepare('UPDATE tickets set idEtat = ? WHERE idTicket = ?');
            $req->execute(array($nouveauEtat, $idTicket));
            return $req;
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
}
