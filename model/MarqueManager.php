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
}
