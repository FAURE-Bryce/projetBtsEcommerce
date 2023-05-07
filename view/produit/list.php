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
        <base href="/Projet%20Web%20FAURE%20Bryce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">  <!-- à refaire sans Bootstrap -->
    </head>
    <body>
        <?php NavBarreController::readAll($params); ?>
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
                        echo '<img src="'.$produit->GetPathPhoto().'" alt="TV '.$produit->GetLibelle().'">';
                        echo '<h3>'.$produit->GetLibelle().'</h3>';
                        echo '<p>'.$produit->GetPrixVenteUht().' €</p>';
                        echo '<div>';
                            echo '<a href="produit/detail/'.$produit->getId().'/"><input type="button" value="Voir +"></a>';
                            echo '<a href="'.$lienAjouterAuPanier.'"><input type="button" value="Ajouter au panier"></a>'; // à faire
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>