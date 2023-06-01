<?php

/**
 * /model/TypeEcranManager.php
 * Définition de la class TypeEcranManager
 *
 * @author B.FAURE
 * @date 03/2023
 */

class TypeEcranManager {
    
    private static ?\PDO $cnx;
    private static $unTypeEcran;
    private static $lesTypesEcrans = array();
    
    /**
     * Récupère la list des Types Ecrans 
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
     * Récupère l'id d'un type ecran d'on le libelle est passé en paramétre
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
     * Récupère le type Ecran qui poséde l'id passé en paramétre
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
    
    /**
     * Récupère la list des types écrans avec la pagination
     */
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

    /**
     * Met a jour le type écran avec les informations passé en paramétre
     */
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

    /**
     * Ajout un Type d'écran
     */
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

    /**
     * Donne le nombre de Type d'écran
     */
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
