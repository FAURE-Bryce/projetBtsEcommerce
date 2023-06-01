<?php

/**
 * /model/ProduitManager.php
 * Définition de la class ProduitManager
 *
 * @author B.FAURE
 * @date 02/2023
 */

class ProduitManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Récupère la list des produits
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
    
    /**
     * Récupère la list des produits avec la pagination
     */
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

    /**
     * Récupère le nombre de produits
     */
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
     * Récupère le nombre de produit pour une catégorie
     */
    public static function getNbProduitsByIdTypeEcran(int $id){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbProduit';
            $sql .= ' FROM produit';
            $sql .= ' where idType = :idTypeEcran;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idTypeEcran', $id, PDO::PARAM_INT);
            $result->execute();
            
            $uneLigne = $result->fetch();

            $result->setFetchMode(PDO::FETCH_OBJ);
            
            return $uneLigne[0];
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Récupère le nombre de produit d'une recherche 
     */
    public static function getNbProduitsBySearch(string $search){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbProduit';
            $sql .= ' from produit P';
            $sql .= ' JOIN model M on M.id = P.idModel';
            $sql .= ' WHERE M.libelle LIKE :search';
            $sql .= ' OR P.libelle LIKE :search';
            
            $result = self::$cnx->prepare($sql);
            
            $search = "%".$search."%";

            $result->bindParam('search', $search, PDO::PARAM_STR);
            $result->execute();
            
            $uneLigne = $result->fetch();

            $result->setFetchMode(PDO::FETCH_OBJ);
            
            return $uneLigne[0];
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Récupère la list des produit avec une pagination
     */
    public static function getLesProduitsByPaginationAndByIdTypeEcran(int $id, int $numPage, int $nbElementParPage){
        $lesProduits = array();
        
        $numPage = ($numPage-1)*$nbElementParPage;

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
     * Récupère les produits d'une recherche
     */
    public static function getLesProduitsBySearch(string $search, int $numPage, int $nbElementParPage){
        $lesProduits = array();
        
        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select P.id, idModel, P.libelle, resume, description, pathPhoto, qteEnStock, qteLimite, prixVenteUHT, idMarque, idTaille, idType';
            $sql .= ' from produit P';
            $sql .= ' JOIN model M on M.id = P.idModel';
            $sql .= ' WHERE M.libelle LIKE :search';
            $sql .= ' OR P.libelle LIKE :search';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $search = "%".$search."%";

            $result->bindParam('search', $search, PDO::PARAM_STR);
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
     * Récupère le produit avec une id passé en paramétre 
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
     * Récupère l'id model d'un produit d'on l'id est passé en parramétre
     */
    public static function getIdModelByIdProduit(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select idModel';
            $sql .= ' from produit';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);

            $uneLigne = $result->fetch();

            return $uneLigne->idModel;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Récupères les produit d'un model donnée
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

    /**
     * Met à jour la qte en stock d'un produit
     */
    public static function setQteEnStock(int $idProduit, int $newQte){
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

    /**
     * Met à jour le produit par rapport à l'id donnée en paramétre
     */
    public static function updateProduitById(int $id, Produit $produit){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update produit';
            $sql .= ' set libelle = :libelle,';
            $sql .= ' resume = :resume,';
            $sql .= ' description = :description,';
            $sql .= ' pathPhoto = :pathPhoto,';
            $sql .= ' qteEnStock = :qteEnStock,';
            $sql .= ' prixVenteUHT = :prixVenteUHT,';
            $sql .= ' idModel = :idModel,';
            $sql .= ' idMarque = :idMarque,';
            $sql .= ' idTaille = :idTaille,';
            $sql .= ' idType = :idType';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $libelle = $produit->getLibelle();
            $resume = $produit->getResume();
            $description = $produit->getDescription();
            $pathPhoto = $produit->getPathPhoto();
            $qteEnStock = $produit->getQteEnStock();
            $prixVenteUHT = $produit->getPrixVenteUHT();
            $idModel = $produit->getIdModel();
            $idMarque = $produit->getIdMarque();
            $idTaille = $produit->getIdTaille();
            $idType = $produit->getIdType();

            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->bindParam('resume', $resume, PDO::PARAM_STR);
            $result->bindParam('description', $description, PDO::PARAM_STR);
            $result->bindParam('pathPhoto', $pathPhoto, PDO::PARAM_STR);
            $result->bindParam('qteEnStock', $qteEnStock, PDO::PARAM_STR);
            $result->bindParam('prixVenteUHT', $prixVenteUHT, PDO::PARAM_STR);
            $result->bindParam('idModel', $idModel, PDO::PARAM_INT);
            $result->bindParam('idMarque', $idMarque, PDO::PARAM_INT);
            $result->bindParam('idTaille', $idTaille, PDO::PARAM_INT);
            $result->bindParam('idType', $idType, PDO::PARAM_INT);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Ajout un produit 
     */
    public static function addProduit(Produit $produit){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'INSERT INTO produit (libelle, resume, description, pathPhoto, qteEnStock, prixVenteUHT, idModel, idMarque, idTaille, idType)';
            $sql .= ' VALUES (:libelle, :resume, :description, :pathPhoto, :qteEnStock, :prixVenteUHT, :idModel, :idMarque, :idTaille, :idType)';
            
            $result = self::$cnx->prepare($sql);
            
            $libelle = $produit->getLibelle();
            $resume = $produit->getResume();
            $description = $produit->getDescription();
            $patchPhoto = $produit->getPathPhoto();
            $qteEnStock = $produit->getQteEnStock();
            $prixVenteUHT = $produit->getPrixVenteUHT();
            $idModel = $produit->getIdModel();
            $idMarque = $produit->getIdMarque();
            $idTaille = $produit->getIdTaille();
            $idType = $produit->getIdType();
            
            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->bindParam('resume', $resume, PDO::PARAM_STR);
            $result->bindParam('description', $description, PDO::PARAM_STR);
            $result->bindParam('pathPhoto', $patchPhoto, PDO::PARAM_STR);
            $result->bindParam('qteEnStock', $qteEnStock, PDO::PARAM_STR);
            $result->bindParam('prixVenteUHT', $prixVenteUHT, PDO::PARAM_STR);
            $result->bindParam('idModel', $idModel, PDO::PARAM_INT);
            $result->bindParam('idMarque', $idMarque, PDO::PARAM_INT);
            $result->bindParam('idTaille', $idTaille, PDO::PARAM_INT);
            $result->bindParam('idType', $idType, PDO::PARAM_INT);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
