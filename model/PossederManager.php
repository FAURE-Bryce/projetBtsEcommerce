<?php

/**
 * /model/TailleManager.php
 * Définition de la class TailleManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class PossederManager {
    
    private static ?\PDO $cnx;
    
    // $date doit être au format Y-m-d
    public static function insertPosseder(int $idStatut, int $idCommande, string $date){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'insert into posseder (idStatut, idCommande, datePosseder)';
            $sql .= ' values (:idStatut, :idCommande, :datePosseder)';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idStatut', $idStatut, PDO::PARAM_INT);
            $result->bindParam('idCommande', $idCommande, PDO::PARAM_INT);
            $result->bindParam('datePosseder', $date, PDO::PARAM_STR);
            $result->execute();

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLeSatutByIdCommande(int $idCommande){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select idStatut, datePosseder';
            $sql .= ' from posseder';
            $sql .= ' where idCommande = :idCommande';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idCommande', $idCommande, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);

            $uneLigne = $result->fetch();
            $unPosseder = new Posseder();
            $unPosseder->SetIdStatut($uneLigne->idStatut);
            $unPosseder->SetIdCommande($idCommande);
            $unPosseder->SetDatePosseder(DateTime::createFromFormat('Y-m-d', $uneLigne->datePosseder));

            $unPosseder->SetStatut(StatutCommandeManager::getLeStatutById($uneLigne->idStatut));
            $unPosseder->SetCommande(CommandeManager::getLaCommandeById($idCommande));

            return $unPosseder;

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
