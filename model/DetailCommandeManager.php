<?php

/**
 * /model/TailleManager.php
 * Définition de la class TailleManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class DetailCommandeManager {
    
    private static ?\PDO $cnx;
    
    public static function insertDetailCommande(int $idProduit, int $idCommande, int $qte){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'insert into detailCommande (idProduit, idCommande, qte)';
            $sql .= ' values (:idProduit, :idCommande, :qte)';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idProduit', $idProduit, PDO::PARAM_INT);
            $result->bindParam('idCommande', $idCommande, PDO::PARAM_INT);
            $result->bindParam('qte', $qte, PDO::PARAM_INT);
            $result->execute();

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLesDetailCommandesByIdCommande(int $idCommande){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'SELECT idProduit, qte';
            $sql .= ' FROM detailcommande';
            $sql .= ' WHERE idCommande = :idCommande';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idCommande', $idCommande, PDO::PARAM_INT);
            $result->execute();

            $listDetailCommande = array();

            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unDetailCommande = new DetailCommande();
                $unDetailCommande->SetIdProduit($uneLigne->idProduit);
                $unDetailCommande->SetIdCommande($idCommande);
                $unDetailCommande->SetQte($uneLigne->qte);

                $unDetailCommande->SetProduit(ProduitManager::getLeProduitById($uneLigne->idProduit));
                $unDetailCommande->SetCommande(CommandeManager::getLaCommandeById($idCommande));
                
                array_push($listDetailCommande, $unDetailCommande);
            } 

            return $listDetailCommande;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
