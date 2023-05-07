<?php

    /**
    * /index.php
    * Page d'accueil
    * 
    *
    * @author 1sio-slam
    * @date 05/2021
    */

    // autochargement des class
    require_once __DIR__.'/autoload.php';

    // enregistrement de la racine du site
    define('ROOT', __DIR__);

    // récupère les paramètres de l'url
    $controller = $_GET['controller'];
    $action = $_GET['action'];

    // route vers le controller et l'action
    require_once __DIR__.'/controller/routeur.php';

    // récupère les données depuis la base de données
                /**
                * Teste le filtre section
                */
                if(empty($_GET['typeEcran'])){
                    $filtre = 'tous';
                }else{
                    $filtre = $_GET['typeEcran'];
                }
                var_dump($filtre);
         
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

    // charge la vue demandée
    require_once __DIR__.'/view/etudiant/list.php';

?>


