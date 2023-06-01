<?php

/**
 * /model/DbManager.php
 * Définition de la class DbManager
 * Class qui implémente toutes les fonctions d'accès à la base de données
 *
 * @author B.FAURE
 * @date 02/2023
 */

class DbManager {
    
    // attributs techniques d'accès à la bdd
    private const HOST = '127.0.0.1';
    private const PORT = '3306'; // 3307:MariaDB / 3306: MySQL
    private const DBNAME = 'bddEcommerce';
    private const LOGIN = 'ecommerceUser';
    private const MDP = '#?K?5eFFgdtyH';
    private static ?\PDO $cnx = null;
    
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