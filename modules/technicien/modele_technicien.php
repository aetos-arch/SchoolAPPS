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


	public function changerEtat($idEtat, $idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('update tickets set idEtat = ? where idTicket = ?');
			$req->execute(array($idEtat, $idTicket));
			$result = $req->fetch();
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





	public function getTickets($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idTechnicien=?');
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

	public function getPass($idUtilisateur)
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
