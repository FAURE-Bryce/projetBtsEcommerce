<?php

/**
 * /model/DetailCommandeManager.php
 * Définition de la class DetailCommandeManager
 *
 * @author B.FAURE
 * @date 02/2023
 */

class DetailCommandeManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Insert un nouveau detail commande
     */
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

    /**
     * Récupère la list des details de la commandes d'une commande dont sont id est passé en paramétre 
     */
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

    /**
     * Récupère le detail d'une commande qui comporte l'id de la commande et l'id du produit passé en paramètre
     */
    public static function getLesDetailCommandesByIdCommandeAndByIdProduit(int $idCommande, int $idProduit){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'SELECT idProduit, qte';
            $sql .= ' FROM detailcommande';
            $sql .= ' WHERE idCommande = :idCommande';
            $sql .= ' AND idProduit = :idProduit';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idCommande', $idCommande, PDO::PARAM_INT);
            $result->bindParam('idProduit', $idProduit, PDO::PARAM_INT);
            $result->execute();

            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();
            $unDetailCommande = new DetailCommande();
            $unDetailCommande->SetIdProduit($uneLigne->idProduit);
            $unDetailCommande->SetIdCommande($idCommande);
            $unDetailCommande->SetQte($uneLigne->qte);

            $unDetailCommande->SetProduit(ProduitManager::getLeProduitById($uneLigne->idProduit));
            $unDetailCommande->SetCommande(CommandeManager::getLaCommandeById($idCommande));            

            return $unDetailCommande;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Met à jour le detail d'un commande avec les ilformation donné en paramétre
     */
    public static function updateDetailCommandeByIdCOmmandeAndByIdProduit(int $idCommande, int $idProduit, int $qte){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update detailcommande';
            $sql .= ' set qte = :qte';
            $sql .= ' where idCommande = :idCommande';
            $sql .= ' And idProduit = :idProduit';
            
            $result = self::$cnx->prepare($sql);

            $result->bindParam('qte', $qte, PDO::PARAM_INT);
            $result->bindParam('idCommande', $idCommande, PDO::PARAM_INT);
            $result->bindParam('idProduit', $idProduit, PDO::PARAM_INT);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
