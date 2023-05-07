<?php

/**
 * /model/TypeEcranManager.php
 * Définition de la class TypeEcranManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class TypeEcranManager {
    
    private static ?\PDO $cnx;
    private static $unTypeEcran;
    private static $lesTypesEcrans = array();
    
    /**
     * Obtient un tableau d'objets de tous les typesEcrans
     * à l'aide d'une requête SQL
     * @return TypeEcran array
     */
    public static function getLesTypesEcrans(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' from typeEcran';
            
            $result = self::$cnx->query($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                self::$unTypeEcran = new TypeEcran();
                self::$unTypeEcran->SetId($uneLigne->id);
                self::$unTypeEcran->SetLibelle($uneLigne->libelle);
                array_push(self::$lesTypesEcrans, self::$unTypeEcran);
            } 
            return self::$lesTypesEcrans;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Obtient un typeEcran qui a pour libelle $libelle
     * à l'aide d'une requête SQL
     * @return int 
     */
    public static function getIdTypeEcranByLibelle(string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id ' ;
            $sql .= 'from typeEcran ';
            $sql .= 'where libelle = :libelle';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            
            self::$unTypeEcran = $result->fetch();
            
            return self::$unTypeEcran->id;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Obtient un typeEcran qui a pour id $id
     * à l'aide d'une requête SQL
     * @return TypeEcran 
     */
    public static function getTypeEcranById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= 'from typeEcran ';
            $sql .= 'where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            self::$unTypeEcran = new TypeEcran();
            self::$unTypeEcran->SetId($uneLigne->id);
            self::$unTypeEcran->SetLibelle($uneLigne->libelle);
            
            
            return self::$unTypeEcran;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
