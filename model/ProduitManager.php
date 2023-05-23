<?php

/**
 * /model/ProduitManager.php
 * Définition de la class ProduitManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class ProduitManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Obtient un tableau d'objets de tous les Produits
     * à l'aide d'une requête SQL
     * @return type array
     */
    public static function getLesProduits(){
        $lesProduits = array();
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, idModel, libelle, resume, description, pathPhoto, qteEnStock, qteLimite, prixVenteUHT, idMarque, idTaille, idType';
            $sql .= ' from produit';
            
            $result = self::$cnx->query($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unProduit = new Produit();
                $unProduit->SetId($uneLigne->id);
                $unProduit->SetIdModel($uneLigne->idModel);
                $unProduit->SetLibelle($uneLigne->libelle);
                $unProduit->SetResume($uneLigne->resume);
                $unProduit->SetDescription($uneLigne->description);
                $unProduit->SetPathPhoto($uneLigne->pathPhoto);
                $unProduit->SetQteEnStock($uneLigne->qteEnStock);
                $unProduit->SetPrixVenteUht($uneLigne->prixVenteUHT);
                $unProduit->SetIdMarque($uneLigne->idMarque);
                $unProduit->SetIdTaille($uneLigne->idTaille);
                $unProduit->SetIdType($uneLigne->idType);

                $unProduit->SetType(TypeEcranManager::getTypeEcranById($uneLigne->idType));
                $unProduit->SetMarque(MarqueManager::getMarqueById($uneLigne->idMarque));
                $unProduit->SetTaille(TailleManager::getTailleById($uneLigne->idTaille));
                $unProduit->SetModel(ModelManager::getModelById($uneLigne->idModel));

                array_push($lesProduits, $unProduit);
            } 
            return $lesProduits;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    public static function getLesProduitsByPagination(int $nbElementParPage, int $numPage){
        $lesProduits = array();

        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, idModel, libelle, resume, description, pathPhoto, qteEnStock, qteLimite, prixVenteUHT, idMarque, idTaille, idType';
            $sql .= ' FROM produit';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unProduit = new Produit();
                $unProduit->SetId($uneLigne->id);
                $unProduit->SetIdModel($uneLigne->idModel);
                $unProduit->SetLibelle($uneLigne->libelle);
                $unProduit->SetResume($uneLigne->resume);
                $unProduit->SetDescription($uneLigne->description);
                $unProduit->SetPathPhoto($uneLigne->pathPhoto);
                $unProduit->SetQteEnStock($uneLigne->qteEnStock);
                $unProduit->SetPrixVenteUht($uneLigne->prixVenteUHT);
                $unProduit->SetIdMarque($uneLigne->idMarque);
                $unProduit->SetIdTaille($uneLigne->idTaille);
                $unProduit->SetIdType($uneLigne->idType);

                $unProduit->SetType(TypeEcranManager::getTypeEcranById($uneLigne->idType));
                $unProduit->SetMarque(MarqueManager::getMarqueById($uneLigne->idMarque));
                $unProduit->SetTaille(TailleManager::getTailleById($uneLigne->idTaille));
                $unProduit->SetModel(ModelManager::getModelById($uneLigne->idModel));

                array_push($lesProduits, $unProduit);
            } 
            return $lesProduits;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    public static function getNbProduits(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbProduit';
            $sql .= ' FROM produit;';
            
            $result = self::$cnx->prepare($sql);
            $result->execute();
            
            $uneLigne = $result->fetch();

            $result->setFetchMode(PDO::FETCH_OBJ);
            
            return $uneLigne[0];
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Obtient un tableau des produits qui a pour idType $id
     * à l'aide d'une requête SQL
     * @return int 
     */
    public static function getLesProduitsByIdTypeEcran(int $id){
        $lesProduits = array();
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id, idModel, libelle, resume, description, pathPhoto, qteEnStock, qteLimite, prixVenteUHT, idMarque, idTaille, idType';
            $sql .= ' from produit';
            $sql .= ' where idType = :idTypeEcran';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idTypeEcran', $id, PDO::PARAM_INT);
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unProduit = new Produit();
                $unProduit->SetId($uneLigne->id);
                $unProduit->SetIdModel($uneLigne->idModel);
                $unProduit->SetLibelle($uneLigne->libelle);
                $unProduit->SetResume($uneLigne->resume);
                $unProduit->SetDescription($uneLigne->description);
                $unProduit->SetPathPhoto($uneLigne->pathPhoto);
                $unProduit->SetQteEnStock($uneLigne->qteEnStock);
                $unProduit->SetPrixVenteUht($uneLigne->prixVenteUHT);
                $unProduit->SetIdMarque($uneLigne->idMarque);
                $unProduit->SetIdTaille($uneLigne->idTaille);
                $unProduit->SetIdType($uneLigne->idType);

                $unProduit->SetType(TypeEcranManager::getTypeEcranById($uneLigne->idType));
                $unProduit->SetMarque(MarqueManager::getMarqueById($uneLigne->idMarque));
                $unProduit->SetTaille(TailleManager::getTailleById($uneLigne->idTaille));
                $unProduit->SetModel(ModelManager::getModelById($uneLigne->idModel));
                
                array_push($lesProduits, $unProduit);
            } 
            return $lesProduits;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Obtient un produits qui a pour id $id
     * à l'aide d'une requête SQL
     * @return int 
     */
    public static function getLeProduitById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id, idModel, libelle, resume, description, pathPhoto, qteEnStock, qteLimite, prixVenteUHT, idMarque, idTaille, idType';
            $sql .= ' from produit';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);

            $uneLigne = $result->fetch();
            $unProduit = new Produit();
            $unProduit->SetId($uneLigne->id);
            $unProduit->SetIdModel($uneLigne->idModel);
            $unProduit->SetLibelle($uneLigne->libelle);
            $unProduit->SetResume($uneLigne->resume);
            $unProduit->SetDescription($uneLigne->description);
            $unProduit->SetPathPhoto($uneLigne->pathPhoto);
            $unProduit->SetQteEnStock($uneLigne->qteEnStock);
            $unProduit->SetPrixVenteUht($uneLigne->prixVenteUHT);
            $unProduit->SetIdMarque($uneLigne->idMarque);
            $unProduit->SetIdTaille($uneLigne->idTaille);
            $unProduit->SetIdType($uneLigne->idType);

            $unProduit->SetType(TypeEcranManager::getTypeEcranById($uneLigne->idType));
            $unProduit->SetMarque(MarqueManager::getMarqueById($uneLigne->idMarque));
            $unProduit->SetTaille(TailleManager::getTailleById($uneLigne->idTaille));
            $unProduit->SetModel(ModelManager::getModelById($uneLigne->idModel));

            return $unProduit;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Obtient un tableau des produits qui a pour idModel $idModel
     * à l'aide d'une requête SQL
     * @return int 
     */
    public static function getLesProduitsByModel(int $idModel){
        $lesProduits = array();
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id, idModel, libelle, resume, description, pathPhoto, qteEnStock, qteLimite, prixVenteUHT, idMarque, idTaille, idType';
            $sql .= ' from produit';
            $sql .= ' where idModel = :idModel';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idModel', $idModel, PDO::PARAM_INT);
            $result->execute();
            
            $test = array();

            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unProduit = new Produit();
                $unProduit->SetId($uneLigne->id);
                $unProduit->SetIdModel($uneLigne->idModel);
                $unProduit->SetLibelle($uneLigne->libelle);
                $unProduit->SetResume($uneLigne->resume);
                $unProduit->SetDescription($uneLigne->description);
                $unProduit->SetPathPhoto($uneLigne->pathPhoto);
                $unProduit->SetQteEnStock($uneLigne->qteEnStock);
                $unProduit->SetPrixVenteUht($uneLigne->prixVenteUHT);
                $unProduit->SetIdMarque($uneLigne->idMarque);
                $unProduit->SetIdTaille($uneLigne->idTaille);
                $unProduit->SetIdType($uneLigne->idType);

                $unProduit->SetType(TypeEcranManager::getTypeEcranById($uneLigne->idType));
                $unProduit->SetMarque(MarqueManager::getMarqueById($uneLigne->idMarque));
                $unProduit->SetTaille(TailleManager::getTailleById($uneLigne->idTaille));
                $unProduit->SetModel(ModelManager::getModelById($uneLigne->idModel));
                
                array_push($test, $unProduit);
            } 

            return $test;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function setQteEnStock(int $idProduit, int $newQte){
        $lesProduits = array();
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update produit';
            $sql .= ' set qteEnStock = :qteEnStock';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $idProduit, PDO::PARAM_INT);
            $result->bindParam('qteEnStock', $newQte, PDO::PARAM_INT);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
