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

            // pagination start
            if(empty($_GET['numPage'])){
                $numPage = 1;
            }else{
                $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            }

            $nbElementParPage = 1;

            $nbProduit = ProduitManager::getNbProduits();

            $params['nbPage'] = ceil($nbProduit / $nbElementParPage);

            $params['numPage'] = $numPage;
            // pagination end

            /**
            * Return les produit qui sont dans le typeEcran $libelle
            */
            function getLesProduitsByLibelleTypeEcran($libelle) : array
            {
                $typeEcranSelectionne = new TypeEcran();
                $typeEcranSelectionne->setLibelle($libelle);
                $typeEcranSelectionne->setId(TypeEcranManager::getIdTypeEcranByLibelle($libelle));
                return ProduitManager::getLesProduitsByIdTypeEcran($typeEcranSelectionne->getId());
            }

            /**
            * Filtre la selection de l'utilisateur
            */
            switch($filtre)
            {
                case 'tous':
                    $lesProduits = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
                    break;
                case 'LED':
                    $lesProduits = getLesProduitsByLibelleTypeEcran('LED');
                    break;
                case 'MiniLED':
                    $lesProduits = getLesProduitsByLibelleTypeEcran('MiniLED');
                    break;
                case 'OLED':
                    $lesProduits = getLesProduitsByLibelleTypeEcran('OLED');
                    break;
                case 'QLED':
                    $lesProduits = getLesProduitsByLibelleTypeEcran('QLED');
                    break;
                default :
                    $lesProduits = ProduitManager::getLesProduits();
                    break;
            }

            /**
            * récupère les produits de la bdd
            */
            $params['listProduits'] = $lesProduits;

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

            /**
            * récupère les produits de la bdd
            */
            $params['listProduits'] = ProduitManager::getLesProduits();

            if (isset($_POST['barreRecherche']) && !empty($_POST['barreRecherche'])) {
                $recherche = filter_input(INPUT_POST, 'barreRecherche', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                $nombreElement = 0;
                $listProduitsRecherche = array();

                foreach ($params['listProduits'] as $produit) {
                    if (strpos(strtolower($produit->GetModel()->GetLibelle()), strtolower($recherche))!== FALSE || strpos(strtolower($produit->GetLibelle()), strtolower($recherche)) !== FALSE) {
                        array_push($listProduitsRecherche, $produit);
                        $nombreElement++;
                    }
                }

                if ($nombreElement == 0) {
                    $params['rechercheProduits'] = $recherche;
                }
                else {
                    $params['listProduits'] = $listProduitsRecherche;
                }
            }

            // appelle la vue
            require_once ROOT.'/view/produit/list.php';
        }
    }
?>