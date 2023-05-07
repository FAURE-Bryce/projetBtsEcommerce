<?php

/**
 * /model/SectionManager.php
 * Définition de la class SectionManager
 * Class qui gère les interactions entre les sections de l'application
 *  et les sections de la bdd
 *
 * @author 1sio-slam
 * @date: 05/2021
 */

class SectionManager {
    
    // attributs techniques
    private static ?\PDO $cnx = null;
    
    // attributs métier
    private static $uneSection;
    private static $lesSections = array();
    
    /**
     * Obtient par requête SQL toutes les sections de la BDD
     * en utilisant le mode FETCH_CLASS et en remplissant un tableau d'objets
     * @return array
     */
    public static function getLesSections(): array
    {
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select idsection, libellesection';
            $sql .= ' from section';
            
            $result = self::$cnx->query($sql); 
            
            $result->setFetchMode(PDO::FETCH_CLASS, 'Section');
            while (self::$uneSection = $result->fetch()) {
                self::$lesSections[] = self::$uneSection;
            }
            return self::$lesSections;
        } catch (Exception $ex) {
            die('Erreur : ' . $ex->getMessage());
        }
    }
    
    /**
     * Obtient par requête SQL une section de la BDD
     * qui correspond à l'id passé en paramètre
     * @param type $idsection
     * @return type Section
     */
    public static function getUneSectionById($idsection){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select idsection, libellesection';
            $sql .= ' from section';
            $sql .= ' where idsection= :idsection';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idsection', $idsection, PDO::PARAM_INT);
            
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_CLASS, 'Section');
            $uneSection = $result->fetch();
            return $uneSection;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

