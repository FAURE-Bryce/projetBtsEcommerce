<?php

/**
 * /controller/FooterController.php
 * 
 * Contrôleur pour l'entité FooterController
 *
 * @author 1sio-slam
 * @date 05/2021
 */

    class FooterController {

        /**
         * Action qui affiche la Footer
         * params : tableau des paramètres
         */
        public static function readAll($params){

            // appelle la vue
            require_once ROOT.'/view/navFooter/footer.php';
        }
    }

?>