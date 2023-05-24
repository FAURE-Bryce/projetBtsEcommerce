<?php

/**
 * /controller/ProduitController.php
 * 
 * Contrôleur pour l'entité Produit
 *
 * @author B.Faure
 * @date 03/2023
 */

    class ProduitController {

        /**
         * Action qui affiche la table de tous les Produits
         * params : tableau des paramètres
         */
        public static function list($params){

            if(empty($_GET['numPage'])){
                $numPage = 1;
            }else{
                $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            }

            $nbElementParPage = 6;

            $nbProduit = ProduitManager::getNbProduits();

            $params['nbPage'] = ceil($nbProduit / $nbElementParPage);

            $params['numPage'] = $numPage;

            /**
            * récupère les produits de la bdd
            */
            $params['listProduits'] = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);

            // appelle la vue
            require_once ROOT.'/view/produit/list.php';
        }
        
        /**
         * Action qui affiche la table de tous les Produits
         * params : tableau des paramètres
         */
        public static function listTrier($params){

            /**
            * Teste le filtre section
            */
            if(empty($_GET['typeEcran'])){
                $filtre = 'tous';
            }else{
                $filtre = filter_input(INPUT_GET, 'typeEcran', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            }

            /**
            * Return les produit qui sont dans le typeEcran $libelle
            */
            function getLesProduitsByLibelleTypeEcran(string $libelle) : array
            {
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 6;
    
                $nbProduit = ProduitManager::getNbProduitsByIdTypeEcran(TypeEcranManager::getIdTypeEcranByLibelle($libelle));

                $typeEcranSelectionne = new TypeEcran();
                $typeEcranSelectionne->setLibelle($libelle);
                $typeEcranSelectionne->setId(TypeEcranManager::getIdTypeEcranByLibelle($libelle));

                return array(ProduitManager::getLesProduitsByPaginationAndByIdTypeEcran($typeEcranSelectionne->getId(), $numPage, $nbElementParPage), $numPage, ceil($nbProduit / $nbElementParPage));
            }

            /**
            * Filtre la selection de l'utilisateur
            */
            switch($filtre)
            {
                case 'tous':
                    if(empty($_GET['numPage'])){
                        $numPage = 1;
                    }else{
                        $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    }
        
                    $nbElementParPage = 6;
        
                    $nbProduit = ProduitManager::getNbProduits();
        
                    $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
        
                    $params['numPage'] = $numPage;

                    $lesProduits = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
                    break;
                case 'LED':
                    $tableauReturn = getLesProduitsByLibelleTypeEcran('LED');

                    $params['nbPage'] = $tableauReturn[2];
        
                    $params['numPage'] = $tableauReturn[1];

                    $lesProduits = $tableauReturn[0];
                    break;
                case 'MiniLED':
                    $tableauReturn = getLesProduitsByLibelleTypeEcran('MiniLED');

                    $params['nbPage'] = $tableauReturn[2];
        
                    $params['numPage'] = $tableauReturn[1];
                    
                    $lesProduits = $tableauReturn[0];
                    break;
                case 'OLED':
                    $tableauReturn = getLesProduitsByLibelleTypeEcran('OLED');

                    $params['nbPage'] = $tableauReturn[2];
        
                    $params['numPage'] = $tableauReturn[1];
                    
                    $lesProduits = $tableauReturn[0];
                    break;
                case 'QLED':
                    $tableauReturn = getLesProduitsByLibelleTypeEcran('QLED');

                    $params['nbPage'] = $tableauReturn[2];
        
                    $params['numPage'] = $tableauReturn[1];
                    
                    $lesProduits = $tableauReturn[0];
                    break;
                default :
                    if(empty($_GET['numPage'])){
                        $numPage = 1;
                    }else{
                        $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    }
                
                    $nbElementParPage = 6;
                
                    $nbProduit = ProduitManager::getNbProduits();
                
                    $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
                
                    $params['numPage'] = $numPage;

                    $lesProduits = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
                    break;
            }

            /**
            * récupère les produits de la bdd
            */
            $params['listProduits'] = $lesProduits;

            $params['filtre'] = $filtre;

            // appelle la vue
            require_once ROOT.'/view/produit/list.php';
        }
        
        /**
         * Action qui affiche le detail d'un produit
         * params : tableau des paramètres
         */
        public static function detail($params){

            if (isset($_SESSION['id'])) {
                $params['lienAjouterAuPanier'] = 'panier/ajout/';
            }
            else{
                $params['lienAjouterAuPanier'] = 'gestionCompte/authentification/';
            }
            
            /**
            * Teste le filtre section
            */
            if(empty($_GET['typeEcran'])){
                $filtre = 'tous';
            }else{
                $filtre = filter_input(INPUT_GET, 'typeEcran', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            }

            if(isset($_GET['idProduit']) && !empty($_GET['idProduit'])){
                $id = filter_input(INPUT_GET, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);

                // Échapper les caractères spéciaux dans l'ID de l'utilisateur
                $id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');

                $produitSelect = ProduitManager::getLeProduitById($id);

                $params['produit'] = $produitSelect;

                $listProduits = ProduitManager::getLesProduitsByModel($produitSelect->getIdModel());
                
                if (count($listProduits) != 1) {
                    $params['listProduitsParModel'] = $listProduits;
                }
            }

            // appelle la vue
            require_once ROOT.'/view/produit/detail.php';
        }

        public static function rechercheProduit($params){

            if (isset($_POST['barreRecherche']) && !empty($_POST['barreRecherche'])) {
                $recherche = filter_input(INPUT_POST, 'barreRecherche', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                $listProduitsRechercher = array();

                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 700;
    
                $nbProduit = ProduitManager::getNbProduitsBySearch($recherche);
    
                $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
    
                $params['numPage'] = $numPage;

                $listProduitsRechercher = ProduitManager::getLesProduitsBySearch($recherche, $numPage, $nbElementParPage);
                
                if (count($listProduitsRechercher) == 0) {
                    $params['rechercheProduits'] = $recherche;

                    $nbProduit = ProduitManager::getNbProduits();
    
                    $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
                    
                    /**
                    * récupère les produits de la bdd
                    */
                    $params['listProduits'] = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
                }
                else {
                    $params['listProduits'] = $listProduitsRechercher;
                    $params['rechercheOk'] = true;
                }
            }
            else {
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 6;
    
                $nbProduit = ProduitManager::getNbProduits();
    
                $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                /**
                * récupère les produits de la bdd
                */
                $params['listProduits'] = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
            }

            // appelle la vue
            require_once ROOT.'/view/produit/list.php';
        }
    }
?>