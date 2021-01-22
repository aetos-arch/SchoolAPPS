<?php

require_once 'modules/generique/modele_generique.php';

class ModeleAdmin extends ModeleGenerique
{
	public function __construct()
	{
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

    public function getNombreTicketsParEtat()
    {
        try {
            $req = Connexion::$bdd->prepare('select 
                                                      e.etat
                                                    , COUNT(idTicket) as nbr 
                                                from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat group by e.etat');
            $req->execute();
            return $req->fetchAll();
        } catch (PDOException $e) {
        }
    }

    public function getTicketsPourTechnicien($idUtilisateur)
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

    public function getAllTickets()
    {
        try {
            $req = Connexion::$bdd->prepare('select t.*, e.etat from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat order by e.idEtat');
            $req->execute();
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function getTicketsEtat($idEtat)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets t inner join etats e on t.idEtat = e.idEtat where t.idEtat = ?');
			$req->execute(array($idEtat));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getTicket($idTicket)
	{
		try {
            $req = Connexion::$bdd->prepare('select t.*, e.etat from tickets t 
                                                inner join etats e on t.idEtat = e.idEtat where idTicket=?');
			$req->execute(array($idTicket));
			$result = $req->fetch();
			if ($result === false) {
				throw new Exception("idTicket inexistant");
			} else {
				return $result;
			}
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

	public function changerEtatTicket($idEtat, $idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('update tickets set idEtat = ? where idTicket = ?');
			$req->execute(array($idEtat, $idTicket));
		} catch (PDOException $e) {
		}
	}

	public function assignerTicket($idTicket, $idTechnicien)
	{
		try {
            $req = Connexion::$bdd->prepare('update tickets set idEtat = 1, idTechnicien = ? where idTicket = ?');
			$req->execute(array($idTechnicien, $idTicket));
            return $req;
		} catch (PDOException $e) {
		}
	}

	public function supprimerTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('delete from tickets where idTicket = ?');
			return $req->execute(array($idTicket));
		} catch (PDOException $e) {
		}
	}

	public function nouveauTechnicien($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into utilisateurs(nom, prenom, login, hashMdp, emailFacturation, telephone, idTypeUtilisateur) values (?, ?, ?, ?, ?, ?, ?)');
			return $req->execute(array($result['nom'], $result['prenom'], $result['login'], $result['hashMdp'], $result['emailFacturation'], $result['telephone'], 2));
		} catch (PDOException $e) {
		}
	}

	public function supprimerTechnicien($idTechncien)
	{
		try {
			$req = Connexion::$bdd->prepare('select idTicket from tickets where idTechnicien = ? and idEtat != 0');
			$req->execute(array($idTechncien));
			if ($req) {
				$req = Connexion::$bdd->prepare('delete from utilisateurs where idUtilisateur = ?');
                $req->execute(array($idTechncien));
				return true;

			} else {
				return false;
			}
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

	public function setLogin($idUtilisateur, $newLogin)
	{
		try {
			$req = Connexion::$bdd->prepare('update utilisateurs set login = ? where idUtilisateur= ?');
			$req->execute(array($newLogin, $idUtilisateur));
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

	public function getAllTechniciens()
	{
		try {
			$req = Connexion::$bdd->prepare('select * from utilisateurs where idTypeUtilisateur=?');
			$req->execute(array(2));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}
}
