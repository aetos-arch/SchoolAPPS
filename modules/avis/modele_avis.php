<?php

require_once 'modules/generique/modele_generique.php';

class ModeleAvis extends ModeleGenerique
{
	public function __construct()
	{
	}

	public function donnerAvis($result)
	{
		try {
			$req = Connexion::$bdd->prepare('insert into avis (idUtilisateur, idProduit, titre, commentaire, note) values(?, ?, ?, ?, ?)');
			$req->execute(array($result['idUtilisateur'], $result['idProduit'],  $result['titre'], $result['commentaire'],  $result['note']));
		} catch (PDOException $e) {
		}
	}

	public function avisExiste($idUtilisateur, $idProduit)
	{
		try {
			$req = Connexion::$bdd->prepare('select idUtilisateur from avis where idUtilisateur = ? and idProduit = ?');
			$req->execute(array($idUtilisateur, $idProduit));
			$nb = $req->rowCount();
			return $nb;
		} catch (PDOException $e) {
		}
	}


	public function supprimerAvis($idAvis)
	{
		try {
			$req = Connexion::$bdd->prepare('delete from avis where idAvis = ?');
			$req->execute(array($idAvis));
		} catch (PDOException $e) {
		}
	}

	public function getAvis($idAVis)
	{
		try {
			$req = Connexion::$bdd->prepare('select * from avis where idAVis=?');
			$req->execute(array($idAVis));
			$result = $req->fetchAll();
			return $result;
		} catch (PDOException $e) {
		}
	}

	public function getIdProduit ($nomProduit) {
		try {
			$req = Connexion::$bdd->prepare('select idProduit from produits where nomProduit=?');
			$req->execute(array($nomProduit));
			$idProduit = $req->fetchAll();
			if ($idProduit === false) {
				// exception
			} else {
				return $idProduit;
			}
		 } catch (PDOException $e) {
		}
	}

	public function getAllAvisProduit($idProduit)
	{
		try {
				$req = Connexion::$bdd->prepare('select * from avis where idProduit=?');
				$req->execute(array($idProduit['idProduit']));
				$result = $req->fetchAll();
				return $result;
			} catch (PDOException $e) {
		}
	}
}