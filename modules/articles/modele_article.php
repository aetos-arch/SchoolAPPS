<?php

require_once 'config/connexion.php';

class ModeleArticle extends Connexion
{
    public function __construct()
    {
    }

    public function getIdArticle ($nomArticle) {
		try {
			$req = Connexion::$bdd->prepare('select idArticle from articles where nomArticle=?');
			$req->execute(array($nomArticle));
			$idArticle = $req->fetchAll();
			if ($idArticle === false) {
				throw new Exception("idArticle inexistant");
			} else {
				return $idArticle;
			}
		 } catch (PDOException $e) {
		}
	}

    public function getListeArticles()
    {
        try {
            $req = Connexion::$bdd->prepare('select * from articles limit 6');
            $req->execute();
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }

    public function getArticle($idArticle)
    {
        try {
            $req = Connexion::$bdd->prepare('select * from articles where idArticle = ?');
            $req->execute(array($idArticle));
            $result = $req->fetchAll();
            return $result;
        } catch (PDOException $e) {
        }
    }
}
