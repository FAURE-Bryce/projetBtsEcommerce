<?php

/**
 * /model/EtudiantManager.php
 * Définition de la class EtudiantManager
 * Class qui gère les interactions entre les étudiants de l'application
 *  et les étudiants de la bdd
 *
 * @author 1sio-slam
 * @date 05/2021
 */

class EtudiantManager {
    
    private static ?\PDO $cnx;
    private static $unEtudiant;
    private static $lesEtudiants = array();
    
    /**
     * Obtient un tableau d'objets de tous les étudiants
     * à l'aide d'une requête SQL
     * @return type array
     */
    public static function getLesEtudiants(){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select idetudiant, nom, prenom, datenaissance, email, idsection';
            $sql .= ' from etudiant';
            
            $result = self::$cnx->query($sql);
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $laSection = SectionManager::getUneSectionById($uneLigne->idsection);
                self::$unEtudiant = new Etudiant();
                self::$unEtudiant->setIdEtudiant($uneLigne->idetudiant);
                self::$unEtudiant->setNom($uneLigne->nom);
                self::$unEtudiant->setPrenom($uneLigne->prenom);
                $date = new DateTime($uneLigne->datenaissance);
                self::$unEtudiant->setDateNaissance($date);
                self::$unEtudiant->setEmail($uneLigne->email);
                self::$unEtudiant->setLaSection($laSection);
                self::$lesEtudiants[] = self::$unEtudiant;
            }
            return self::$lesEtudiants;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    /**
     * Obtient un tableau d'objets de tous les étudiants
     * correspondant à la section sélectionnée dans le formulaire filtre
     * à l'aide d'une requête SQL paramétrée
     * @return type array
     */
    public static function getLesEtudiantsBySection(Section $pLaSection){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select idetudiant, nom, prenom, datenaissance, email, s.idsection';
            $sql .= ' from etudiant e';
            $sql .= ' join section s on e.idsection = s.idsection';
            $sql .= ' and libellesection = :libellesection';
            
            $result = self::$cnx->prepare($sql);
           
            $libelle = $pLaSection->getLibelleSection();
            $result->bindParam('libellesection', $libelle, PDO::PARAM_STR);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                self::$unEtudiant = new Etudiant();
                self::$unEtudiant->setIdEtudiant($uneLigne->idetudiant);
                self::$unEtudiant->setNom($uneLigne->nom);
                self::$unEtudiant->setPrenom($uneLigne->prenom);
                $date = new DateTime($uneLigne->datenaissance);
                self::$unEtudiant->setDateNaissance($date);
                self::$unEtudiant->setEmail($uneLigne->email);
                self::$unEtudiant->setLaSection($pLaSection);
                self::$lesEtudiants[] = self::$unEtudiant;
            }
            return self::$lesEtudiants;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
