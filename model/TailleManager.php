<?php

/**
 * /model/TailleManager.php
 * Définition de la class TailleManager
 *
 * @author B.FAURE
 * @date 02/2023
 */

class TailleManager {
    
    private static ?\PDO $cnx;
    
    /**
     * Récupère la taille qui posséde l'id passé en parramétre
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

    /**
     * Donne la list des tailles d'écrans
     */
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

    /**
     * Récupère la list des tailles d'écrans par rapport a la pagination
     */
    public static function getLesTaillesByPagination(int $nbElementParPage, int $numPage){
        $lesTailles = array();

        $numPage = ($numPage-1)*$nbElementParPage;

        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select id, libelle';
            $sql .= ' FROM Taille';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unTaille = new Taille();
                $unTaille->SetId($uneLigne->id);
                $unTaille->SetLibelle($uneLigne->libelle);

                array_push($lesTailles, $unTaille);
            } 
            return $lesTailles;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Met à jour la la taille avec des info passé en parramétre
     */
    public static function updateTailleById(int $id, string $libelle){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'update Taille';
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

    /**
     * Ajout une taille d'écran
     */
    public static function addTaille(Taille $taille){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'INSERT INTO Taille (libelle)';
            $sql .= ' VALUES (:libelle)';
            
            $result = self::$cnx->prepare($sql);

            $libelle = $taille->getLibelle();

            $result->bindParam('libelle', $libelle, PDO::PARAM_STR);
            $result->execute();
            
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Récupère le nombre de tailles d'écrans
     */
    public static function getNbTailles(){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbTailles';
            $sql .= ' FROM Taille';
            
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
