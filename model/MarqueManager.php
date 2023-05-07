<?php

/**
 * /model/MarqueManager.php
 * Définition de la class MarqueManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class MarqueManager {
    
    private static ?\PDO $cnx;
    private static $uneMarque;
    private static $lesMarques = array();
    
    /**
     * Obtient un marque qui a pour id $id
     * à l'aide d'une requête SQL
     * @return Marque 
     */
    public static function getMarqueById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= 'from marque ';
            $sql .= 'where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            self::$uneMarque = new Marque();
            self::$uneMarque->SetId($uneLigne->id);
            self::$uneMarque->SetLibelle($uneLigne->libelle);
            
            return self::$uneMarque;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
