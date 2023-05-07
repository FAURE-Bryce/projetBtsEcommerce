<?php

/**
 * /model/TailleManager.php
 * Définition de la class TailleManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class TailleManager {
    
    private static ?\PDO $cnx;
    private static $uneTaille;
    private static $lesTailles = array();
    
    /**
     * Obtient un typeEcran qui a pour id $id
     * à l'aide d'une requête SQL
     * @return Taille 
     */
    public static function getTailleById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= 'from taille ';
            $sql .= 'where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            self::$uneTaille = new Taille();
            self::$uneTaille->SetId($uneLigne->id);
            self::$uneTaille->SetLibelle($uneLigne->libelle);
            
            return self::$uneTaille;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
