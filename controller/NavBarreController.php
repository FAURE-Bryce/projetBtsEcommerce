<?php

/**
 * /controller/NavBarreController.php
 * 
 * Contrôleur pour la barre de navigation pour les page web
 *
 * @author B.FAURE
 * @date 02/2023
 */

    class NavBarreController {

        /**
         * Affiche la barre de navigation des users non admin
         */
        public static function readAll($params){
            
            if (isset($_SESSION['id'])) {
                $params['libelleConnexion'] = "Compte";
                $params['etatConnexion'] = "Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom'];
                $params['lienConnexion'] = "gestionCompte/compte/";
                $params['lienPanier'] = "panier/list/";
            }
            else{
                $params['libelleConnexion'] = "Connexion";
                $params['etatConnexion'] = "";
                $params['lienConnexion'] = "gestionCompte/authentification/";
                $params['lienPanier'] = "gestionCompte/authentification/";
            }

            $params['listTypesEcrans'] = TypeEcranManager::getLesTypesEcrans();

            require_once ROOT.'/view/navFooter/nav-barre.php';

        }

        /**
         * Affiche la barre de navigation des users admin
         */
        public static function readAdminAll($params){
            
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                
                require_once ROOT.'/view/navFooter/nav-barre-admin.php';

            }


        }
    }

?>