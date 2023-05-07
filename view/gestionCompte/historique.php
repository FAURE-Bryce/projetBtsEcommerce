<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Historique</title>
    <meta charset="UTF-8">
    <base href="/Projet%20Web%20FAURE%20Bryce/">

    <!-- CSS only -->
    <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/Header_Footer.css">
    <link rel="stylesheet" href="CSS/GestionCompte.css">
</head>
<body>
    <?php NavBarreController::readAll($params); ?>
    
    <div id="all_historique">
        <h4>Historique de commande</h4>
        <?php
            foreach ($params['listeCommande'] as $uneCommandeClient) {
                $leStatutDeLaCommande = PossederManager::getLeSatutByIdCommande($uneCommandeClient->GetId());

                echo '<div class="commande_num">';
                echo '<div id="libelle_commande_num">';
                echo '<p class="num_Commande">Identifiant de commande n°'.$uneCommandeClient->GetId().'</p>';
                echo '<p class="num_Commande">'.$leStatutDeLaCommande->GetStatut()->GetLibelle().'</p>';
                echo '</div>';
                echo '<div class="commande">';
                
                foreach (DetailCommandeManager::getLesDetailCommandesByIdCommande($uneCommandeClient->GetId()) as $unDetailCommande) {

                    $produit = $unDetailCommande->GetProduit();

                    echo '<div class = "produit">';
                        echo '<img src="'.$produit->GetPathPhoto().'" alt="TV '.$produit->GetLibelle().'" class="logo">';
                        echo '<div class="model_libelle">';
                        echo '<h3>'.$produit->GetLibelle().'</h3>';
                        echo '<p>'.$produit->GetModel()->GetLibelle().'</p>';
                        echo '</div>';
                        echo '<div class="prix_qte">';
                        echo '<p> à l\'unité '.$produit->GetPrixVenteUht(). ' €</p>';
                        echo '<p>Qte : '.$unDetailCommande->GetQte().'</p>';
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
        ?>  
    </div>
    <?php FooterController::readAll($params); ?>
</body>
</html>