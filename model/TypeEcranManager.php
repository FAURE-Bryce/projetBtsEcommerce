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
    

    public static function getLesTypeEcransByPagination(int $nbElementParPage, int $numPage){
        $lesTypeEcrans = array();

        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' FROM TypeEcran';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unTypeEcran = new TypeEcran();
                $unTypeEcran->SetId($uneLigne->id);
                $unTypeEcran->SetLibelle($uneLigne->libelle);

                array_push($lesTypeEcrans, $unTypeEcran);
            } 
            return $lesTypeEcrans;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function updateTypeEcranById(int $id, string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update TypeEcran';
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

    public static function addTypeEcran(TypeEcran $typeEcran){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'INSERT INTO TypeEcran (libelle)';
            $sql .= ' VALUES (:libelle)';
            
            $result = self::$cnx->prepare($sql);

            $libelle = $typeEcran->getLibelle();

            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getNbTypeEcrans(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbTypeEcrans';
            $sql .= ' FROM TypeEcran';
            
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
