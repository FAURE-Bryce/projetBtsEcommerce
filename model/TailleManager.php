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

            $uneTaille = new Taille();
            $uneTaille->SetId($uneLigne->id);
            $uneTaille->SetLibelle($uneLigne->libelle);
            
            return $uneTaille;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLesTailles(){
        $lesTailles = array();
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' from taille';
            
            $result = self::$cnx->query($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $uneTaille = new Taille();
                $uneTaille->SetId($uneLigne->id);
                $uneTaille->SetLibelle($uneLigne->libelle);
                array_push($lesTailles, $uneTaille);
            } 
            return $lesTailles;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
