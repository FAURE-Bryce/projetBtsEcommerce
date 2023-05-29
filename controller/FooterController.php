<?php

/**
 * /controller/FooterController.php
 * 
 * Contrôleur pour le Footer des pages web
 *
 * @author B.FAURE
 * @date 02/2023
 */

    class FooterController {

        /**
         * Affiche la footer
         */
        public static function readAll($params){
            require_once ROOT.'/view/navFooter/footer.php';
        }
    }

?>