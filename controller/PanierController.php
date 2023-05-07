<?php

/**
 * /controller/PanierController.php
 * 
 * Contrôleur pour le panier
 *
 * @author B.Faure
 * @date 03/2023
 */

    class PanierController {

        public static function ajout($params){

            $params['modePaiement'] = ModePaiementManager::getModePaiement();
            
            if(!isset($_POST['qte'])){
                $idProduit = intval(filter_input(INPUT_GET, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP));
                if (count($_SESSION['panier']) != 0) {
                    $i = 0;
                    while ($i < count($_SESSION['panier'])-1 && $_SESSION['panier'][$i]->getProduit()->getId() != $idProduit) {
                        $i++;
                    }
                    if ($_SESSION['panier'][$i]->GetProduit()->GetId() == $idProduit) {
                        if (($_SESSION['panier'][$i]->getQte() + 1) <= $_SESSION['panier'][$i]->getProduit()->getQteEnStock()) {
                            $_SESSION['panier'][$i]->setQte($_SESSION['panier'][$i]->getQte() + 1);
                        }
                    }
                    else {
                        $nouvelArticlePanier = new ArticlePanier;
                        $nouvelArticlePanier->setQte(1);
                        $nouvelArticlePanier->setProduit(ProduitManager::getLeProduitById($idProduit));
                        array_push($_SESSION['panier'], $nouvelArticlePanier);
                    }
                }
                else {
                    $nouvelArticlePanier = new ArticlePanier;
                    $nouvelArticlePanier->setQte(1);
                    $nouvelArticlePanier->setProduit(ProduitManager::getLeProduitById($idProduit));
                    array_push($_SESSION['panier'], $nouvelArticlePanier);
                }
            }
            else {
                $idProduit = intval(filter_input(INPUT_POST, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP));
                $qte = intval(filter_input(INPUT_POST, 'qte', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP));
                if (count($_SESSION['panier']) != 0) {
                    $i = 0;
                    while ($i < count($_SESSION['panier'])-1 && $_SESSION['panier'][$i]->getProduit()->getId() != $idProduit) {
                        $i++;
                    }
                    if ($_SESSION['panier'][$i]->GetProduit()->GetId() == $idProduit) {
                        if (($_SESSION['panier'][$i]->getQte() + $qte) <= $_SESSION['panier'][$i]->getProduit()->getQteEnStock()) {
                            $_SESSION['panier'][$i]->setQte($_SESSION['panier'][$i]->getQte() + $qte);
                        }
                    }
                    else {
                        $nouvelArticlePanier = new ArticlePanier;
                        $nouvelArticlePanier->setQte($qte);
                        $nouvelArticlePanier->setProduit(ProduitManager::getLeProduitById($idProduit));
                        array_push($_SESSION['panier'], $nouvelArticlePanier);
                    }
                }
                else {
                    $nouvelArticlePanier = new ArticlePanier;
                    $nouvelArticlePanier->setQte($qte);
                    $nouvelArticlePanier->setProduit(ProduitManager::getLeProduitById($idProduit));
                    array_push($_SESSION['panier'], $nouvelArticlePanier);
                }
            }

            // appelle la vue
            require_once ROOT.'/view/panier/listArticle.php';
        }

        public static function list($params){

            $params['modePaiement'] = ModePaiementManager::getModePaiement();

            // appelle la vue
            require_once ROOT.'/view/panier/listArticle.php';
        }

        public static function quantitePlusMoins($params){

            $params['modePaiement'] = ModePaiementManager::getModePaiement();

            if (isset($_GET['plusMoins']) && !empty($_GET['plusMoins'])) {
                $plusMoins = filter_input(INPUT_GET, 'plusMoins', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                if (isset($plusMoins) && !empty($plusMoins)) {
                    if (isset($_GET['idProduit']) && !empty($_GET['idProduit'])) {
                        $idProduit = intval(filter_input(INPUT_GET, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP));
                        if ($plusMoins == 'moins') {
                            $panierArray = $_SESSION['panier'];
                            
                            if (count($panierArray) != 0) {
                                $i = 0;
                                while ($i <= count($panierArray) && $panierArray[$i]->GetProduit()->GetId() != $idProduit) {
                                    $i++;
                                }
                                if ($panierArray[$i]->GetProduit()->GetId() == $idProduit) {
                                    $panierArray[$i]->SetQte($panierArray[$i]->GetQte()-1);
                                    if ($panierArray[$i]->GetQte() == 0) {
                                        unset($_SESSION['panier'][array_search($panierArray[$i],$panierArray)]);
                                    }
                                }
                            }
                            
                        }
                        elseif ($plusMoins == 'plus') {
                            $panierArray = $_SESSION['panier'];

                            if (count($panierArray) != 0) {
                                $i = 0;
                                while ($i <= count($panierArray) && $panierArray[$i]->GetProduit()->GetId() != $idProduit) {
                                    $i++;
                                }
                                if ($panierArray[$i]->GetProduit()->GetId() == $idProduit) {
                                    if ($panierArray[$i]->GetQte()+1 <= $panierArray[$i]->GetProduit()->GetQteEnStock()) {
                                        $panierArray[$i]->SetQte($panierArray[$i]->GetQte()+1);
                                    }
                                    else {
                                        $params['erreurQteProduitMax'] = true;
                                    }
                                }
                            }
                        }
                    }            
                }
            
            }

            // appelle la vue
            require_once ROOT.'/view/panier/listArticle.php';
        }

        public static function passerCommande($params){

            $params['modePaiement'] = ModePaiementManager::getModePaiement();

            if (isset($_POST['PasserCommande']) && count($_SESSION['panier']) != 0) {
                $idModePaiement = intval(filter_input(INPUT_POST, 'modePaiement', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP));
                
                CommandeManager::insertCommande($idModePaiement, $_SESSION['id']);
                $idCommande = CommandeManager::getLastIdCommande();

                PossederManager::insertPosseder(StatutCommandeManager::getIdStatutCommandeByLibelle("préparation"), $idCommande, date('Y-m-d'));

                foreach ($_SESSION['panier'] as $lesArticlePanier) {
                    DetailCommandeManager::insertDetailCommande($lesArticlePanier->getProduit()->getId(), $idCommande, $lesArticlePanier->getQte());
                    ProduitManager::setQteEnStock($lesArticlePanier->getProduit()->getId(), ($lesArticlePanier->GetProduit()->GetQteEnStock() - $lesArticlePanier->getQte()));
                }

                array_splice($_SESSION['panier'], 0, count($_SESSION['panier']));
                
                $params['commandeOk'] = true;
            }
            

            // appelle la vue
            require_once ROOT.'/view/panier/listArticle.php';
        }
    }
?>