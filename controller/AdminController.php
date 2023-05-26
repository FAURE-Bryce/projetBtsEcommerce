<?php

/**
 * /controller/TypeEcranController.php
 * 
 * Contrôleur pour l'entité TypeEcran
 *
 * @author B.Faure
 * @date 03/2023
 */
                    /* affichafge a faire user, commande, produit */
    class AdminController {

        public static function listProduit($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbProduit = ProduitManager::getNbProduits();
    
                $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                /**
                * récupère les produits de la bdd
                */
                $params['listProduits'] = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
    
                // appelle la vue
                require_once ROOT.'/view/admin/listProduit.php';
            }
            
        }

        public static function updateProduit($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(isset($_GET['idProduit'])){
                    $idProduit = filter_input(INPUT_GET, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['produit'] = ProduitManager::getLeProduitById($idProduit);
                $params['listeMarque'] = MarqueManager::getLesMarques();
                $params['listeType'] = TypeEcranManager::getLesTypesEcrans();
                $params['listeTaille'] = TailleManager::getLesTailles();

                if(isset($_POST['model']) && !empty($_POST['model']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['resume']) && !empty($_POST['resume']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['patchPhoto']) && !empty($_POST['patchPhoto']) && isset($_POST['qteEnStock']) && !empty($_POST['qteEnStock']) && isset($_POST['prixVenteUht']) && !empty($_POST['prixVenteUht']) && isset($_POST['idMarque']) && !empty($_POST['idMarque']) && isset($_POST['idTaille']) && !empty($_POST['idTaille']) && isset($_POST['idType']) && !empty($_POST['idType'])){
                    $nouveauLibelleModel = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $patchPhoto = filter_input(INPUT_POST, 'patchPhoto', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $qteEnStock = filter_input(INPUT_POST, 'qteEnStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $prixVenteUht = filter_input(INPUT_POST, 'prixVenteUht', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $idMarque = filter_input(INPUT_POST, 'idMarque', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $idTaille = filter_input(INPUT_POST, 'idTaille', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $idType = filter_input(INPUT_POST, 'idType', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                if(isset($_POST['formModification'])){
                    $modificationProduit = filter_input(INPUT_POST, 'formModification', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    ModelManager::updateLibelleModelById(ProduitManager::getIdModelByIdProduit($idProduit), $nouveauLibelleModel);

                    $produit = new Produit;
                    $produit->setLibelle($libelle);
                    $produit->setIdModel(ProduitManager::getIdModelByIdProduit($idProduit));
                    $produit->setResume($resume);
                    $produit->setDescription($description);
                    $produit->SetPathPhoto($patchPhoto);
                    $produit->setQteEnStock($qteEnStock);
                    $produit->setPrixVenteUHT($prixVenteUht);
                    $produit->setIdMarque($idMarque);
                    $produit->setIdTaille($idTaille);
                    $produit->setIdType($idType);

                    ProduitManager::updateProduitById($idProduit, $produit);
                    $updated = true;
                }

                if (isset($updated) && $updated == true) {
                    $params['updated'] = $updated;
                    AdminController::listProduit(array_splice($params, 0));
                }
                else {
                    // appelle la vue
                    require_once ROOT.'/view/admin/updateProduit.php';
                }
                
            }
            
        }

    }

?>