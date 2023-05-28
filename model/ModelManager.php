<?php

/**
 * /model/ModelManager.php
 * Définition de la class ModelManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class ModelManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Obtient un model qui a pour id $id
     * à l'aide d'une requête SQL
     * @return Model 
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
