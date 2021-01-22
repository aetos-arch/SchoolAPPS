<?php

require_once 'modules/generique/modele_generique.php';

class ModelePanier extends ModeleGenerique
{

    public function creationPanier($idUtil)
    {
        //Vérification s'il y a déjà un panier
        try {
            $selectPreparee = Connexion::$bdd->prepare('SELECT * FROM paniers WHERE idUtilisateur=:idUtil;');
            $selectPreparee->execute(array(':idUtil' => $idUtil));
            $resultat = $selectPreparee->fetchAll();

            if ($selectPreparee->rowCount() < 1) {
                //Si le panier n'existe pas
                $selectPrepareeInsert = Connexion::$bdd->prepare('INSERT INTO `paniers` 
                    (`dateCreation`, `total`, `idUtilisateur`) 
                    VALUES (NOW(), \'0\', :idUtil)');
                $selectPrepareeInsert->execute(array(':idUtil' => $idUtil));

                //Assignation du nouveau panier à la variable de session du panier :
                $selectPrepareeSelect = Connexion::$bdd->prepare('SELECT * FROM paniers
                    WHERE idUtilisateur=:idUtil');
                $selectPrepareeSelect->execute(array(':idUtil' => $idUtil));
                $resultat = $selectPrepareeSelect->fetchAll();
                $_SESSION['panier'] = $resultat[0]['idPanier'];
            } else {
                //Il existe déjà un panier
                $_SESSION['panier'] = $resultat[0]['idPanier'];
            }
        } catch (PDOException $e) {
        }
    }

    public function recuperationPanier($idUtil, $idPanier)
    {
        $selectPreparee = Connexion::$bdd->prepare('SELECT 
                    T0.total AS TotalPanier,
                    T1.idProduit,
                    T1.qteProduits,
                    T2.nomProduit,
                    T2.prixHT
                    FROM paniers T0 
                    INNER JOIN produitsPanier T1 ON T0.idPanier = T1.idPanier
                    INNER JOIN produits T2 ON T1.idProduit = T2.idProduit
                    WHERE T0.idUtilisateur=:idUtil AND T0.idPanier=:idPanier');
        $reponse = array(':idUtil' => $idUtil, ':idPanier' => $idPanier);
        $selectPreparee->execute($reponse);
        $resultat = $selectPreparee->fetchAll();
        return $resultat;
    }

    function supprimerProduit($idProduit,$idPanier)
    {
        //Mis à jour du total du panier
        $selectPrepareeProduit = Connexion::$bdd->prepare('SELECT 
                T0.prixHT,
                T1.qteProduits
                FROM produits T0
                INNER JOIN produitsPanier T1 ON T0.idProduit = T1.idProduit
                WHERE T0.idProduit=:idProduit;');
        $selectPrepareeProduit->execute(array(':idProduit' => $idProduit));
        $reponse = $selectPrepareeProduit->fetchAll();

        $modifPrepareeMAJTotal = Connexion::$bdd->prepare('UPDATE paniers SET total=total-:prixAncienProduit*:qteProduits
                    WHERE idPanier=:idPanier');
        $modifPrepareeMAJTotal->execute(array(':prixAncienProduit' => $reponse[0]['prixHT'], ':qteProduits' => $reponse[0]['qteProduits'], ':idPanier' => $idPanier));

        //Suppression du produit
        $selectPreparee = Connexion::$bdd->prepare('DELETE FROM produitsPanier WHERE idProduit=:idProduit');
        $reponse = array(':idProduit' => $idProduit);
        $req = $selectPreparee->execute($reponse);

        return $req;
    }

    function getIDPanier($idUtil)
    {
        try {

            $req = Connexion::$bdd->prepare('SELECT idPanier from paniers where idUtilisateur=:idUtil');
            $req->execute(array(':idUtil' => $idUtil));
            $reponse = $req->fetchAll();
            return $reponse[0]['idPanier'];
        } catch (PDOException $e) {
        }
    }

    function ajouterProduitPanier($idProduit, $idPanier)
    {
        try {
            //Voir si le panier comprend déjà ce produit
            $selectPreparee = Connexion::$bdd->prepare('SELECT * FROM produitsPanier 
                WHERE idProduit=:idProduit AND idPanier=:idPanier;');
            $selectPreparee->execute(array(':idProduit' => $idProduit, ':idPanier' => $idPanier));

            if ($selectPreparee->rowCount() > 0) {
                //Quand le panier comprend déjà ce produit, alors on ajoute 1 à la quantité.
                $modifPreparee = Connexion::$bdd->prepare('UPDATE produitsPanier SET qteProduits=qteProduits+1
                    WHERE idProduit=:idProduit AND idPanier=:idPanier');
                $modifPreparee->execute(array(':idProduit' => $idProduit, ':idPanier' => $idPanier));

            } else {
                //TODO : revoir gestion quantité
                $insertPreparee = Connexion::$bdd->prepare('INSERT INTO produitsPanier 
                (qteProduits, idProduit, idPanier) VALUES (1, :idProduit, :idPanier)');
                $insertPreparee->execute(array(':idProduit' => $idProduit, ':idPanier' => $idPanier));
                //TODO : Peut-être faire une vérification que le produit a bien été ajouté
            }
            //Mis à jour du total du panier
            $selectPrepareeProduit = Connexion::$bdd->prepare('SELECT prixHT FROM produits 
                WHERE idProduit=:idProduit;');
            $selectPrepareeProduit->execute(array(':idProduit' => $idProduit));
            $reponse = $selectPrepareeProduit->fetchAll();

            $modifPrepareeMAJTotal = Connexion::$bdd->prepare('UPDATE paniers SET total=total+:prixNouvProduit
                    WHERE idPanier=:idPanier');
            $modifPrepareeMAJTotal->execute(array(':prixNouvProduit' => $reponse[0]['prixHT'], ':idPanier' => $idPanier));

        } catch (PDOException $e) {
        }
    }

    static function avoirNBProduitsPanier($idPanier)
    {
        try {
            $selectPreparee = Connexion::$bdd->prepare('SELECT SUM(qteProduits) AS SommePanier 
                FROM produitsPanier where idPanier=:idPanier');
            $selectPreparee->execute(array(':idPanier' => $idPanier));
            $reponse = $selectPreparee->fetchAll();
            if ($reponse[0]['SommePanier'] == NULL) {
                return 0;
            } else {
                return $reponse[0]['SommePanier'];
            }
        } catch (PDOException $e) {
        }
    }

    function moinsQte($idProduit, $idPanier)
    {
        try {
            $selectPreparee = Connexion::$bdd->prepare('SELECT qteProduits
                FROM produitsPanier 
                WHERE idProduit=:idProduit AND idPanier=:idPanier');
            $selectPreparee->execute(array(':idProduit' => $idProduit, ':idPanier' => $idPanier));
            $reponse = $selectPreparee->fetchAll();
            if ($reponse[0]['qteProduits'] == 1) {
                //TODO : voir pour afficher un PopUp
                $this->supprimerProduit($idProduit);
            } else {
                $modifPreparee = Connexion::$bdd->prepare('UPDATE produitsPanier SET qteProduits=qteProduits-1
                    WHERE idProduit=:idProduit AND idPanier=:idPanier');
                $modifPreparee->execute(array(':idProduit' => $idProduit, ':idPanier' => $idPanier));
            }
            //Mis à jour du total du panier
            $selectPrepareeProduit = Connexion::$bdd->prepare('SELECT prixHT FROM produits 
                WHERE idProduit=:idProduit;');
            $selectPrepareeProduit->execute(array(':idProduit' => $idProduit));
            $reponse = $selectPrepareeProduit->fetchAll();

            $modifPrepareeMAJTotal = Connexion::$bdd->prepare('UPDATE paniers SET total=total-:prixAncienProduit
                    WHERE idPanier=:idPanier');
            $modifPrepareeMAJTotal->execute(array(':prixAncienProduit' => $reponse[0]['prixHT'], ':idPanier' => $idPanier));
        } catch (PDOException $e) {
        }
    }

    function plusQte($idProduit, $idPanier)
    {
        try {
            $modifPreparee = Connexion::$bdd->prepare('UPDATE produitsPanier SET qteProduits=qteProduits+1
                    WHERE idProduit=:idProduit AND idPanier=:idPanier');
            $modifPreparee->execute(array(':idProduit' => $idProduit, ':idPanier' => $idPanier));

            //Mis à jour du total du panier
            $selectPrepareeProduit = Connexion::$bdd->prepare('SELECT prixHT FROM produits 
                WHERE idProduit=:idProduit;');
            $selectPrepareeProduit->execute(array(':idProduit' => $idProduit));
            $reponse = $selectPrepareeProduit->fetchAll();

            $modifPrepareeMAJTotal = Connexion::$bdd->prepare('UPDATE paniers SET total=total+:prixAncienProduit
                    WHERE idPanier=:idPanier');
            $modifPrepareeMAJTotal->execute(array(':prixAncienProduit' => $reponse[0]['prixHT'], ':idPanier' => $idPanier));
        } catch (PDOException $e) {
        }
    }

    function passagePanierCommande($idPanier, $idUtilisateur)
    {
        try {
            //Création d'une commande
            $insertPrepareeCommande = Connexion::$bdd->prepare('INSERT INTO commandes
                (dateAchat, idUtilisateur) 
                VALUES (NOW(), :idU)');
            $insertPrepareeCommande->execute(array(':idU' => $idUtilisateur));

            //Recherche de la commande qui vient d'être passé
            $idCommande = Connexion::$bdd->lastInsertId();

            //Sauvegarde des produits dans la table de produitsCommande
            $selectPreparee = Connexion::$bdd->prepare('SELECT 
                T0.idProduit,
                T0.qteProduits,
                T1.nomProduit,
                T1.description,
                T1.prixHT
                FROM produitsPanier T0
                INNER JOIN produits T1 ON T0.idProduit=T1.idProduit
                WHERE idPanier=:idPanier');
            $selectPreparee->execute(array(':idPanier' => $idPanier));
            $reponse = $selectPreparee->fetchAll();
            for ($i = 0; $i < count($reponse); $i++) {
                $insertPreparee = Connexion::$bdd->prepare('INSERT INTO produitsCommandes 
                (nomProduit, qteProduit, prixHT, description, idCommandes) 
                VALUES (:nomP, :qteP, :prixHTP, :descriptionP, :idCommande)');
                $insertPreparee->execute(array(
                    ':nomP' => $reponse[$i]['nomProduit'], ':qteP' => $reponse[$i]['qteProduits'],
                    ':prixHTP' => $reponse[$i]['prixHT'], ':descriptionP' => $reponse[$i]['description'],
                    'idCommande' => $idCommande
                ));
            }

            return $this->supprimerPanier($idPanier);
        } catch (PDOException $e) {
        }
    }

    function supprimerPanier($idPanier)
    {
        //TODO : que faire s'il y a une erreur ?
        //Suppression tout les éléments du panier
        $supProduitPanier = Connexion::$bdd->prepare('DELETE FROM produitsPanier WHERE idPanier=:idPanier');
        $supProduitPanier->execute(array(':idPanier' => $idPanier));

        //Suppression du panier
        $supPanier = Connexion::$bdd->prepare('DELETE FROM paniers WHERE idPanier=:idPanier');
        $req = $supPanier->execute(array(':idPanier' => $idPanier));
        if ($req) {
            unset($_SESSION['panier']);
        }
    }

    function misAJourTotalPanier($idPanier){
        //Mis à jour du total du panier
        $selectPrepareeProduit = Connexion::$bdd->prepare('SELECT 
                T0.qteProduits,
                T1.prixHT
                FROM produitspanier T0
                INNER JOIN produits T1 ON T0.idProduit = T1.idProduit
                WHERE idPanier=:idPanier');
        $selectPrepareeProduit->execute(array(':idPanier' => $idPanier));
        $reponse = $selectPrepareeProduit->fetchAll();

        $total = 0;
        for ($i = 0; $i < count($reponse); $i++) {
            echo 'test';
            $total += $reponse[$i]['prixHT']*$reponse[$i]['qteProduits'];
        }

        $modifPrepareeMAJTotal = Connexion::$bdd->prepare('UPDATE paniers SET total=:totalMAJ
                    WHERE idPanier=:idPanier');
        $modifPrepareeMAJTotal->execute(array(':totalMAJ' => $total, ':idPanier' => $idPanier));

    }

}
