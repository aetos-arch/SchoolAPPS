<?php

require_once 'modules/generique/modele_generique.php';

class ModeleUtilisateur extends ModeleGenerique
{
	public function __construct()
	{
	}

	public function getCommande($idCommande)
	{
		try {
			$req = Connexion::$bdd->prepare('SELECT * FROM commandes c INNER JOIN panier p ON c.idUtilisateur=p.idtilisateur WHERE p.idPanier=c.idpanier AND c.idCommandes = ?');
			$req->execute(array($idCommande));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getCommandes($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('SELECT * FROM commandes c INNER JOIN panier p ON c.idUtilisateur=p.idtilisateur WHERE p.idPanier=c.idpanier AND c.idUtilisateur= ?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getTicket($idTicket)
	{
		try {
			$req = Connexion::$bdd->prepare('SELECT * FROM tickets WHERE idTicket =?');
			$req->execute(array($idTicket));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}


	public function getTickets($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('SELECT * FROM tickets WHERE idUtilisateur=?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}	

	public function creerTicket($result)
	{
		try {
			$req = Connexion::$bdd->prepare('INSERT INTO tickets (intitule, explication, idEtat, idUtilisateur, idProduit) VALUES(?, ?, ?, ?, ?)');
			$req->execute(array($result['intitule'], $result['explication'],  3, $result['idUtilisateur'],  $result['idProduit']));
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

	public function getPassword($idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('SELECT hashMdp FROM utilisateurs WHERE idUtilisateur=?');
			$req->execute(array($idUtilisateur));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function setPass($hashMdp, $idUtilisateur)
	{
		try {
			$req = Connexion::$bdd->prepare('UPDATE utilisateurs set hashMdp = ? WHERE idUtilisateur= ?');
			$req->execute(array($hashMdp, $idUtilisateur));
		} catch (PDOException $e) {
		}
	}
}
