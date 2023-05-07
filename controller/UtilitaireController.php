<?php

/**
 * /controller/UtilitaireController.php
 * 
 * UtilitaireController est là pour les methodes utilitaires
 *
 * @author B.Faure
 * @date 03/2023
 */

    class UtilitaireController {
        public static function check_password($password) {
            $mdpBon = true;
            // Vérifier si le mot de passe est d'au moins 12 caractères de long
            if (strlen($password) < 12) {
                $mdpBon = false;
            }
            
            // Vérifier si le mot de passe contient au moins une majuscule, une minuscule et un chiffre
            if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
                $mdpBon = false;
            }
            
            // Vérifier si le mot de passe contient au moins un caractère spécial
            if (!preg_match('/[^A-Za-z0-9]/', $password)) {
                $mdpBon = false;
            }
            return $mdpBon;
        }
    }
?>

