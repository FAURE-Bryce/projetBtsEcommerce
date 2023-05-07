<?php

/**
 * /model/DbManager.php
 * Définition de la class DbManager
 * Class qui implémente toutes les fonctions d'accès à la base de données
 *
 * @author 1sio-slam
 * @date 05/2021
 */

class DbManager {
    
    // attributs techniques d'accès à la bdd
    private const HOST = '127.0.0.1';
    private const PORT = '3307'; // 3307:MariaDB / 3308: MySQL
    private const DBNAME = 'db_etudiants';
    private const LOGIN = 'root';
    private const MDP = '';
    private static ?\PDO $cnx = null;
    
    // attributs métier
    private static $uneSection;
    private static $lesSections = array();
    private static $unEtudiant;
    private static $lesEtudiants = array();
    
    public static function getConnection(){
        if(self::$cnx == null){
            try {
                self::$cnx = new PDO('mysql:host='. self::HOST.';port='.self::PORT.';dbname='. self::DBNAME.';charset=utf8', self::LOGIN, self::MDP);  
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$cnx;
    }
    
}

?>