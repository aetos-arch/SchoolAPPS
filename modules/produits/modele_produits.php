<?php

require_once 'modules/generique/modele_generique.php';

class ModeleProduit extends ModeleGenerique
{
    public function __construct()
    {
    }

    public function getIdProduit ($nomProduit) {
		try {
			$req = Connexion::$bdd->prepare('select idProduit from produits where nomProduit=?');
			$req->execute(array($nomProduit));
			$idProduit = $req->fetchAll();
			if ($idProduit === false) {
				throw new Exception("idProduit inexistant");
			} else {
				return $idProduit;
			}
		 } catch (PDOException $e) {
		}
    }
    
    public function getProduit($idProduit)
    {
        try {
			$req = Connexion::$bdd->prepare('SELECT * FROM produits WHERE idProduit = ?');
			$req->execute(array($idProduit));
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function getAllProduit()
    {
        try {
            $req = Connexion::$bdd->prepare('SELECT * FROM produits');
            $req->execute();
            $result = $req->fetchAll();
            return $result;
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
