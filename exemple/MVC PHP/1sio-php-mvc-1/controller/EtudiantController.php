<?php

/**
 * /controller/EtudiantController.php
 * 
 * Contrôleur pour l'entité Etudiant
 *
 * @author 1sio-slam
 * @date 05/2021
 */

    class EtudiantController {

        /**
         * Action qui affiche la table de tous les étudiants
         * params : tableau des paramètres
         * filtre_section permet de choisir entre Tous, SISR ou SLAM
         */
        public static function readAll($params){

                /**
                * Teste le filtre section
                */
                if(empty($params['filtre_section'])){
                    $filtre = 'tous';
                }else{
                    $filtre = $params['filtre_section'];
                }
            
                /**
                * récupère les étudiants de la bdd
                */
            
                switch($filtre)
                {
                    case 'tous':
                        $lesEtudiants = EtudiantManager::getLesEtudiants();
                        break;
                    case 'sisr':
                        $uneSection = new Section();
                        $uneSection->setLibelleSection('2SIO SISR');
                        $lesEtudiants = EtudiantManager::getLesEtudiantsBySection($uneSection);
                        break;
                    case 'slam':
                        $uneSection = new Section();
                        $uneSection->setLibelleSection('2SIO SLAM');
                        $lesEtudiants = EtudiantManager::getLesEtudiantsBySection($uneSection);
                        break;
                    default :
                        $lesEtudiants = EtudiantManager::getLesEtudiants();
                }

            // appelle la vue
            require_once ROOT.'/view/etudiant/list.php';

        }
    }

?>