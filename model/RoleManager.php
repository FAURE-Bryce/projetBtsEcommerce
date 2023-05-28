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

    public static function getLesRolesByPagination(int $nbElementParPage, int $numPage){
        $lesRoles = array();

        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' FROM role';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
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

    public static function updateRoleById(int $id, string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update role';
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

    public static function addRole(Role $role){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'INSERT INTO role (libelle)';
            $sql .= ' VALUES (:libelle)';
            
            $result = self::$cnx->prepare($sql);

            $libelle = $role->getLibelle();

            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getNbRoles(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbRoles';
            $sql .= ' FROM role';
            
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
