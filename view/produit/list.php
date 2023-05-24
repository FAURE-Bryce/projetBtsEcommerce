<?php

/**
 * /view/produit/list.php
 * 
 * Affiche la table des produits
 *
 * @author B.FAURE
 * @date 02/2023
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Produit</title>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">  <!-- à refaire sans Bootstrap -->
    </head>
    <body>
        <?php NavBarreController::readAll($params); ?>
        <div id="all">
            <div id="divG">
                <?php
                    if (isset($params['rechercheProduits'])) {
                        echo '<div id = "ErreurRecherche">';
                        echo '<img src="img/gif-stop-1.gif" alt="gif">';
                        echo "<p>Désolé mais il n'y a pas de produit avec comme libellé ou modèle ".$params['rechercheProduits'].".</p>";
                        echo '<img src="img/gif-stop-1.gif" alt="gif">';
                        echo '</div>';
                    }
                    foreach ($params['listProduits'] as $produit) {
                        if (isset($_SESSION['id'])) {
                            $lienAjouterAuPanier = 'panier/ajout/'.$produit->GetId().'/';
                        }
                        else{
                            $lienAjouterAuPanier = 'gestionCompte/authentification/';
                        }

                        echo '<div class="produit">';
                            echo '<div>';
                                echo '<img src="'.$produit->GetPathPhoto().'" alt="TV '.$produit->GetLibelle().'">';
                                echo '<h3>'.$produit->GetLibelle().'</h3>';
                                echo '<p>'.$produit->GetPrixVenteUht().' €</p>';
                            echo '</div>';
                            echo '<div id=btProtuit>';
                                echo '<a href="produit/detail/'.$produit->getId().'/"><input type="button" value="Voir +"></a>';
                                echo '<a href="'.$lienAjouterAuPanier.'"><input type="button" value="Ajouter au panier"></a>';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
            <?php
                $nbPage = $params['nbPage'];

                $numPage = $params['numPage'];

                if ($nbPage != 1 || isset($params['rechercheProduits'])) {
                    if (!empty($params['filtre']) && isset($params['filtre']) && $params['filtre'] != 'tous') {
                        $lienpagination = '<a href="typeEcran/'.$params['filtre'].'/';
                    }
                    elseif (!empty($params['rechercheOk']) && isset($params['rechercheOk']) && $params['rechercheOk'] == true) {
                        $lienpagination = '<a href="produit/recherche/';
                    }
                    else{
                        $lienpagination = '<a href="';
                    }

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