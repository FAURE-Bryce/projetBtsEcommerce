<?php

/**
 * /model/RoleManager.php
 * Définition de la class RoleManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class RoleManager {
    
    private static ?\PDO $cnx;
    
    public static function getLesRoles(){
        $lesRoles = array();
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= ' from role';
            
            $result = self::$cnx->prepare($sql);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unRole = new Role();
                $unRole->SetId($uneLigne->id);
                $unRole->SetLibelle($uneLigne->libelle);

                array_push($lesRoles, $unRole);
            } 

            return $lesRoles;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    public static function getRoleById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= 'from role ';
            $sql .= 'where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            $unRole = new Role();
            $unRole->SetId($uneLigne->id);
            $unRole->SetLibelle($uneLigne->libelle);
            
            return $unRole;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getRoleByLibelle(string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = ' select id, libelle ' ;
            $sql .= 'from role ';
            $sql .= 'where libelle = :libelle';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('libelle', $libelle, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            $unRole = new Role();
            $unRole->SetId($uneLigne->id);
            $unRole->SetLibelle($uneLigne->libelle);
            
            return $unRole;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
