<?php
require_once 'connexion.php';
class ModeleAdmin extends Connexion
{
	public function __construct()
	{
	}

	public function getTickets()
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets');
			$req->execute();
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idTicket = ?');
			$req->execute(array($idTicket));
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function assigneTicket($idTechnicien)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into tickets(idTechnicien) values(?)');
			$req->execute(array($idTechnicien));
		} catch (PDOException $e) {
		}
	}

	public function deleteTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('delete from tickets where idTicket = ?');
			$req->execute(array($idTicket));
		} catch (PDOException $e) {
		}
	}


	public function newTechnicien($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into utilisateurs(nom, prenom, login, hashMdp, telephone, idTypeUtilisayeur) values (?, ?, ?, ?, ?, ?)');
			$req->execute(array($result['nom'], $result['prenom'], $result['login'], $result['hashMdp'], $result['telephone'], 2));
		} catch (PDOException $e) {
		}
	}


	public function deleteTechnicien($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('delete from utilisateurs where idUtilisateur = ?');
			$req->execute(array($idUtilisateur));
		} catch (PDOException $e) {
		}
	}


	public function stat()
	{
		try {
			$req = Connexion::$bdd->prepare('');
			$req->execute(array());
			$nb = $req->rowCount();
			return $nb;
		} catch (PDOException $e) {
		}
	}


	public function pseudoExiste($newPseudo)
	{
		try {
			$req = Connexion::$bdd->prepare('select login from utilisateurs where login = ?');
			$req->execute(array($newPseudo));
			$nb = $req->rowCount();
			return $nb;
		} catch (PDOException $e) {
		}
	}

	public function setPseudo($idUtilisateur, $newPseudo)
	{
		try {
			$req = Connexion::$bdd->prepare('update utilisateurs set login = ? where idUtilisateur= ?');
			$req->execute(array($newPseudo, $idUtilisateur));
		} catch (PDOException $e) {
		}
	}

	public function getPassword($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('select hashMdp from utilisateurs where idUtilisateur=?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetch();
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
