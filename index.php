<?php
    /**
    * /index.php
    * Page d'accueil
    *
    * @author B.FAURE
    * @date 02/2023
    */

    // autochargement des class
    require_once __DIR__.'/autoload.php';

    // enregistrement de la racine du site
    define('ROOT', __DIR__);
    
    // vérification de l'existence des paramètres controller et action dans l'URL
    if (!isset($_GET['controller']) && !isset($_GET['action'])) {
        // paramètres par défaut
        $controller = 'Produit';
        $action = 'list';
    }
    else {
        // récupère les paramètres de l'url
        $controller = $_GET['controller'];
        $action = $_GET['action'];
    }

    // route vers le controller et l'action
    require_once __DIR__.'/controller/routeur.php';

?>


