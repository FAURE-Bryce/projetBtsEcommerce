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
    private static $unModel;
    private static $lesModels = array();
    
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

            self::$unModel = new Model();
            self::$unModel->SetId($uneLigne->id);
            self::$unModel->SetLibelle($uneLigne->libelle);
            
            return self::$unModel;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
