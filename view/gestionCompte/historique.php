<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Historique</title>
    <meta charset="UTF-8">
    <base href="/projetBtsEcommerce/">

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
        <?php
        $nbPage = $params['nbPage'];

        $numPage = $params['numPage'];

        if ($nbPage != 1) {
            
            $lienpagination = '<a href="gestionCompte/historique/';

            echo '<div id="paginationCadre">';
            echo '<div class="pagination">';

            if ($numPage-1 == 0) {
                echo '<p><</p>';
            }
            else{
                echo $lienpagination.($numPage-1).'/"><</a>';
            }

            if (1 < ($numPage-1)) {
                echo $lienpagination.'1/">1</a>';
                echo '<p>...</p>';
                // echo $lienpagination.($numPage-1).'/">'.($numPage-1).'</a>';
            }
            elseif (1 >= ($numPage-2)) {
                for ($i=1; ($numPage - $i) == 1; $i++) { 
                    echo $lienpagination.($numPage-$i).'/">'.($numPage-$i).'</a>';
                }
            }

            echo '<p class="pageActuel">'.$numPage.'</p>';

            if ($nbPage > ($numPage+1)) {
                // echo $lienpagination.($numPage+1).'/">'.($numPage+1).'</a>';
                echo '<p>...</p>';
                echo $lienpagination.$nbPage.'/">'.$nbPage.'</a>';
            }
            elseif ($nbPage <= ($numPage+2)) {
                for ($i=1; ($numPage+$i) == $nbPage; $i++) { 
                    echo $lienpagination.($numPage+$i).'/">'.($numPage+$i).'</a>';
                }
            }

            if ($numPage+1 > $nbPage) {
                echo '<p>></p>';
            }
            else{
                echo $lienpagination.($numPage+1).'/">></a>';
            }

            echo '</div>';
            echo '</div>';
        } 
    ?>  
    </div>
    <?php FooterController::readAll($params); ?>
</body>
</html>