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
}
