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

            $uneMarque = new Marque();
            $uneMarque->SetId($uneLigne->id);
            $uneMarque->SetLibelle($uneLigne->libelle);
            
            return $uneMarque;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    public static function getLesMarques(){
        $lesMarques = array();
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' from marque';
            
            $result = self::$cnx->query($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $uneMarque = new Marque();
                $uneMarque->SetId($uneLigne->id);
                $uneMarque->SetLibelle($uneLigne->libelle);
                array_push($lesMarques, $uneMarque);
            } 
            return $lesMarques;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLesMarquesByPagination(int $nbElementParPage, int $numPage){
        $lesMarques = array();

        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' FROM Marque';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unMarque = new Marque();
                $unMarque->SetId($uneLigne->id);
                $unMarque->SetLibelle($uneLigne->libelle);

                array_push($lesMarques, $unMarque);
            } 
            return $lesMarques;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function updateMarqueById(int $id, string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update Marque';
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

    public static function addMarque(Marque $marque){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'INSERT INTO Marque (libelle)';
            $sql .= ' VALUES (:libelle)';
            
            $result = self::$cnx->prepare($sql);

            $libelle = $marque->getLibelle();

            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getNbMarques(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbMarques';
            $sql .= ' FROM Marque';
            
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
