<?php

/**
 * /model/StatutCommandeManager.php
 * Définition de la class StatutCommandeManager
 *
 * @author B.FAURE
 * @date 02/2023
 */

class StatutCommandeManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Récupère l'id statut par rapport à un libelle passé en parramétre
     */
    public static function getIdStatutCommandeByLibelle(string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id';
            $sql .= ' from statutCommande';
            $sql .= ' where libelle = :libelle';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);

            $uneLigne = $result->fetch();

            return $uneLigne->id;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Récupère le statut qui posséde l'id passé en parramétre
     */
    public static function getLeStatutById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select libelle';
            $sql .= ' from statutCommande';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_STR);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);

            $uneLigne = $result->fetch();
            $unStatut = new StatutCommande();
            $unStatut->SetId($id);
            $unStatut->SetLibelle($uneLigne->libelle);

            return $unStatut;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
