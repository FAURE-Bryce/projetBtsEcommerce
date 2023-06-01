<?php

/**
 * /model/ModelManager.php
 * Définition de la class ModelManager
 *
 * @author B.FAURE
 * @date 02/2023
 */

class ModelManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Récupère un model par rapport à l'id passé en paramétre  
     */
    public static function getModelById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= 'from model ';
            $sql .= 'where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            $unModel = new Model();
            $unModel->SetId($uneLigne->id);
            $unModel->SetLibelle($uneLigne->libelle);
            
            return $unModel;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Met à jour un model avec les informations passé en paramétre
     */
    public static function updateLibelleModelById(int $id, string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update model';
            $sql .= ' set libelle = :libelle';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Récupère la list des model
     */
    public static function getLesModels(){
        $lesModels = array();
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' from model';
            
            $result = self::$cnx->query($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unModel = new Model();
                $unModel->SetId($uneLigne->id);
                $unModel->SetLibelle($uneLigne->libelle);
                array_push($lesModels, $unModel);
            } 
            return $lesModels;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Récupère une list des models par rapport a la pagination
     */
    public static function getLesModelsByPagination(int $nbElementParPage, int $numPage){
        $lesModels = array();

        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' FROM model';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unModel = new Model();
                $unModel->SetId($uneLigne->id);
                $unModel->SetLibelle($uneLigne->libelle);

                array_push($lesModels, $unModel);
            } 
            return $lesModels;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Met à jour un model avec les inforamtion en paramétre
     */
    public static function updateModelById(int $id, string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update model';
            $sql .= ' set libelle = :libelle';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);

            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Ajout un nouveau model
     */
    public static function addModel(Model $model){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'INSERT INTO model (libelle)';
            $sql .= ' VALUES (:libelle)';
            
            $result = self::$cnx->prepare($sql);

            $libelle = $model->getLibelle();

            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Récupère le nombre de model
     */
    public static function getNbModels(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbModels';
            $sql .= ' FROM model';
            
            $result = self::$cnx->prepare($sql);
            $result->execute();
            
            $uneLigne = $result->fetch();

            $result->setFetchMode(PDO::FETCH_OBJ);
            
            return $uneLigne[0];
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
