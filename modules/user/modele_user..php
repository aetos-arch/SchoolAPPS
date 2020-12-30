<?php
require_once 'connexion.php';
class ModeleUser extends Connexion
{
	public function __construct()
	{
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

	public function creerTicket($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into tickets (intitule, explication, idEtat, idUtilisateur, idProduit) values(?, ?, ?, ?, ?)');
			$req->execute(array($result['intitule'], $result['explication'],  2,  $_SESSION['idUtil'],  $result['idProduit']));
		} catch (PDOException $e) {
		}
	}

	public function pseudoExiste($newPseudo)
	{
		try {
			$req = Connexion::$bdd->prepare('select idUtilisateur from utilisateur where idUtilisateur = ?');
			$req->execute(array($newPseudo));
			$nb = $req->rowCount();
			return $nb;
		} catch (PDOException $e) {
		}
	}

	public function setPseudo($idUtilisateur, $newPseudo)
	{
		try {
			$req = Connexion::$bdd->prepare('update utilisateur set idUtilisateur = ? where idUtilisateur= ?');
			$req->execute(array($newPseudo, $idUtilisateur));
		} catch (PDOException $e) {
		}
	}

	public function getPassword($id)
	{
		try {
			$req = Connexion::$bdd->prepare('select hashMdp from utilisateur where idUtilisateur=?');
			$req->execute(array($id));
			$result = $req->fetch();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function setPass($hashMdp, $idUser)
	{
		try {
			$req = Connexion::$bdd->prepare('update utilisateur set hashMdp = ? where idUser= ?');
			$req->execute(array($hashMdp, $idUser));
		} catch (PDOException $e) {
		}
	}
}
