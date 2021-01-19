<?php

require_once 'modules/generique/modele_generique.php';

class ModelePanier extends ModeleGenerique
{

    public function creationPanier($idUtil){
        //Vérification s'il y a déjà un panier
        try {
            $selectPreparee = Connexion::$bdd->prepare('SELECT * FROM paniers WHERE idUtilisateur=:idUtil;');
            $selectPreparee->execute(array(':idUtil' => $idUtil));
            $resultat = $selectPreparee->fetchAll();

            if($selectPreparee->rowCount()<1){
                //Si le panier n'existe pas
                echo '<main>Panier inexistant : </main>'; //TEST

                $selectPrepareeInsert =Connexion::$bdd->prepare('INSERT INTO `paniers` 
                    (`dateCreation`, `total`, `qteProduits`, `idUtilisateur`) 
                    VALUES (NOW(), \'0\', \'0\', :idUtil)');
                $selectPrepareeInsert->execute(array(':idUtil' => $idUtil));

                //Assignation du nouveau panier à la variable de session du panier :
                $selectPrepareeSelect =Connexion::$bdd->prepare('SELECT * FROM paniers
                    WHERE idUtilisateur=:idUtil');
                $selectPrepareeSelect->execute(array(':idUtil' => $idUtil));
                $resultat = $selectPrepareeSelect->fetchAll();
                echo '<main>Panier existant maintenant: '.$resultat[0].'</main>'; //TEST
                $_SESSION['panier']=$resultat[0]['idPanier'];
            }else{
                //Il existe déjà un panier
                echo '<main>Panier existant : '.$resultat[0]['idPanier'].'</main>'; //TEST
                $_SESSION['panier']=$resultat[0]['idPanier'];
            }
        } catch (PDOException $e) {
        }
    }

    public function recuperationPanier($idUtil, $idPanier){
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

    function supprimerProduit($idProduit){
        $selectPreparee = Connexion::$bdd->prepare('DELETE FROM produitsPanier WHERE idProduit=:idProduit');
        $reponse = array(':idProduit' => $idProduit);
        $req = $selectPreparee->execute($reponse);
        return $req;
    }

}
