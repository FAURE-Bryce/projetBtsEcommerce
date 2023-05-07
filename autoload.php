<?php

    /**
     * Charge les class
     */

    function my_autoloader($class_name) {
       $directories = array(
           'model',
           'classe',
           'controller'
       );
       foreach ($directories as $directory) {
           $file = __DIR__ . '/' . $directory . '/' . $class_name . '.php';
           if (file_exists($file)) {
               require_once $file;
               return;
           }
       }
    }

    spl_autoload_register('my_autoloader');

    
    // require_once __DIR__.'/model/DbManager.php';
    // require_once __DIR__.'/classe/ArticlePanier.php';
    // require_once __DIR__.'/classe/Model.php';
    // require_once __DIR__.'/classe/Marque.php';
    // require_once __DIR__.'/classe/Taille.php';
    // require_once __DIR__.'/classe/TypeEcran.php';
    // require_once __DIR__.'/classe/Produit.php';
    // require_once __DIR__.'/classe/StatutCommande.php';
    // require_once __DIR__.'/classe/Role.php';
    // require_once __DIR__.'/classe/User.php';
    // require_once __DIR__.'/classe/ModePaiement.php';
    // require_once __DIR__.'/classe/Commande.php';
    // require_once __DIR__.'/classe/Posseder.php';
    // require_once __DIR__.'/classe/DetailCommande.php';
    // require_once __DIR__.'/model/ProduitManager.php';
    // require_once __DIR__.'/model/TypeEcranManager.php';
    // require_once __DIR__.'/model/MarqueManager.php';
    // require_once __DIR__.'/model/TailleManager.php';
    // require_once __DIR__.'/model/ModelManager.php';
    // require_once __DIR__.'/model/RoleManager.php';
    // require_once __DIR__.'/model/UserManager.php';
    // require_once __DIR__.'/controller/NavBarreController.php';
    // require_once __DIR__.'/controller/FooterController.php';
    // require_once __DIR__.'/controller/ProduitController.php';
    // require_once __DIR__.'/controller/UtilitaireController.php';
    session_start();
?>