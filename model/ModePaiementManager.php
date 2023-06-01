<?php

/**
 * /model/ModePaiementManager.php
 * Définition de la class ModePaiementManager
 *
 * @author B.FAURE
 * @date 02/2023
 */

class ModePaiementManager {
    
    private static ?\PDO $cnx;

    /**
     * Récupère la list des modes de paiements
     */
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

    /**
     * Récupère le mode de paiement par l'id passé en paramétre
     */
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
