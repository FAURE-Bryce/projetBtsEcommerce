<?php

/**
 * /model/TailleManager.php
 * Définition de la class TailleManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class ModePaiementManager {
    
    private static ?\PDO $cnx;
    private static $unModePaiement;

    public static function getModePaiement(){
        $lesModesPaiement = array();
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' from modepaiement';
            
            $result = self::$cnx->query($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($leModePaiement = $result->fetch()) {
                $unModePaiement = new ModePaiement();
                $unModePaiement->SetId($leModePaiement->id);
                $unModePaiement->SetLibelle($leModePaiement->libelle);

                array_push($lesModesPaiement, $unModePaiement);
            } 
            return $lesModesPaiement;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getModePaiementById(int $id){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' from modepaiement';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);

            $leModePaiement = $result->fetch();
            $unModePaiement = new ModePaiement();
            $unModePaiement->SetId($leModePaiement->id);
            $unModePaiement->SetLibelle($leModePaiement->libelle);
            
            return $unModePaiement;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
