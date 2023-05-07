<?php

/**
 * /controller/NavBarreController.php
 * 
 * Contrôleur pour l'entité NavBarreController
 *
 * @author 1sio-slam
 * @date 05/2021
 */

    class NavBarreController {

        /**
         * Action qui affiche la NavBar
         * params : tableau des paramètres
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

            /**
            * récupère les typeEcran de la bdd
            */
            $params['listTypesEcrans'] = TypeEcranManager::getLesTypesEcrans();

            // appelle la vue
            require_once ROOT.'/view/navFooter/nav-barre.php';

        }
    }

?>