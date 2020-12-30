<?php
require_once '../../config/connexion.php';
class ModeleUser extends Connexion
{
	public function __construct()
	{
	}

	public function getCommande($idCommande)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from paniers where idCommande =?');
			$req->execute(array($idCommande));
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getCommandes($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from paniers where idUtilisateur=?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idTicket =?');
			$req->execute(array($idTicket));
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}


	public function getTickets($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from tickets where idUtilisateur=?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function creerTicket($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into tickets (intitule, explication, idEtat, idUtilisateur, idProduit) values(?, ?, ?, ?, ?)');
			$req->execute(array($result['intitule'], $result['explication'],  2, $result['idUtilisateur'],  $result['idProduit']));
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
