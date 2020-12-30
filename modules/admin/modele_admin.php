<?php
require_once 'connexion.php';
class ModeleAdmin extends Connexion
{
	public function __construct()
	{
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
