<?php
require_once 'connexion.php';
class ModeleUser extends Connexion
{
	public function __construct()
	{
	}

	public function ticket($result)
	{
	}

	public function getCommandes($idUtilisateur)
	{
		$req = Connexion::$bdd->prepare('select * from panier where idUtilisateur=?');
		$req->execute(array($idUtilisateur));
		$result = $req->fetch();
		return $result;
	}

	public function creerTicket($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into tickets values(?, ?, ?, ?, ?, ?)');
			$req->execute(array($result[''], $result['intitule'], $result['explication'],  1,  $_SESSION['idUtil'],  $result['idProduit']));
		} catch (PDOException $e) {
		}
	}

	public function pseudoExiste($newPseudo)
	{
		$req = Connexion::$bdd->prepare('select idUtilisateur from utilisateur where idUtilisateur = ?');
		$req->execute(array($newPseudo));
		$nb = $req->rowCount();
		return $nb;
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
		$req = Connexion::$bdd->prepare('select hashMdp from utilisateur where idUtilisateur=?');
		$req->execute(array($id));
		$result = $req->fetch();
		return $result;
	}

	public function setPass($mdp, $id)
	{
		$req = Connexion::$bdd->prepare('update utilisateur set hashMdp = ? where idUser= ?');
		$req->execute(array($mdp, $id));
	}
}
