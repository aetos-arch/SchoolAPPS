<?php

require_once 'modules/generique/modele_generique.php';

class ModeleAdmin extends ModeleGenerique
{
	public function __construct()
	{
	}

	public function getTicketsEtat($idEtat)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idEtat = ?');
			$req->execute(array($idEtat));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idTicket = ?');
			$req->execute(array($idTicket));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}


	public function changerEtatTicket($idEtat, $idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('update tickets set idEtat = ? where idTicket = ?');
			$req->execute(array($idEtat, $idTicket));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}


	public function assignerTicket($idTechnicien)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into tickets(idTechnicien) values(?)');
			$req->execute(array($idTechnicien));
		} catch (PDOException $e) {
		}
	}

	public function supprimerTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('delete from tickets where idTicket = ?');
			$req->execute(array($idTicket));
		} catch (PDOException $e) {
		}
	}


	public function nouveauTechnicien($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into utilisateurs(nom, prenom, login, hashMdp, telephone, idTypeUtilisayeur) values (?, ?, ?, ?, ?, ?)');
			$req->execute(array($result['nom'], $result['prenom'], $result['login'], $result['hashMdp'], $result['telephone'], 2));
		} catch (PDOException $e) {
		}
	}


	public function supprimerTechnicien($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('delete from utilisateurs where idUtilisateur = ?');
			$req->execute(array($idUtilisateur));
		} catch (PDOException $e) {
		}
	}


	// To do
	public function stat()
	{
		try {
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
}
