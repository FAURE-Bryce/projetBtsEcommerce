<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <base href="/projetBtsEcommerce/">
    <title>Panier</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/Header_Footer.css">
    <link rel="stylesheet" href="CSS/Panier_CSS.css">
</head>
<body>
    <div id="all_panier">
        <?php
        NavBarreController::readAll($params);

        $total = 0;
        $prixLivraison = 19.99;
        ?>
        <h4>Panier</h4>
        <div id="div_produit_prix_total">
            <div id="div_tout_produit">
                <?php
                if (isset($params['commandeOk']) && $params['commandeOk'] == true) {
                    echo '<div id="commandeOk">';
                    echo '<p>Votre commande a bien été passée, pour plus de detail rendez-vous sur le page "mon compte" pour voir l\'avenacé de votre commende</p>';
                    echo '</div>';
                }

                if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
                    $tableauPanier = $_SESSION['panier'];

                    $strock = '<p class="enStock">En stock </p>';
                    if (isset($params['erreurQteProduitMax']) && $params['erreurQteProduitMax'] == true) {
                        echo '<div id="erreur_quantite">';
                        echo '<p>erreur : la quantité de ce produit est au maximum</p>';
                        echo '</div>';
                    }

                    foreach ($tableauPanier as $produitPanier) {
                        $produit = $produitPanier->GetProduit();

                        if ($produit->getQteEnStock() == 0) {
                            $strock = '<p class="ruptureStock">Rupture de stock </p>';
                        }
                    ?>
                        <div class="div_produit">
                            <img src="<?php echo $produit->GetPathPhoto(); ?>" alt="">
                            <div class="libelle_qte">
                                <h3><?php echo $produit->GetLibelle(); ?></h3>
                                <div class="stock_pouce_qte">
                                    <div>
                                        <?php echo $strock ;?>
                                        <p><?php echo $produit->GetTaille()->getLibelle() ?> pouces</p>
                                    </div>
                                    <div class="qte">
                                        <p>Quantité: <?php echo $produitPanier->GetQte(); ?></p>
                                        <div>
                                            <?php echo '<a href="panier/quantitePlusMoins/moins/'.$produit->getId().'/"><input type="button" value = "-"></a>' ?>
                                            <?php echo '<a href="panier/quantitePlusMoins/plus/'.$produit->getId().'/"><input type="button" value = "+"></a>' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3>Prix : </h3>
                                <p><?php echo $produit->getPrixVenteUHT()*120/100; ?> €</p>
                                <?php $total += $produit->getPrixVenteUHT() * $produitPanier->GetQte();?>
                            </div>
                        </div>
                    <?php
                    }
                }
                
                ?>
            </div>
            <form action="panier/passerCommande/" method="post">
                <div id="div_prix_total">
                    <h3>Prix</h3>
                    <div id="modePaiement">
                        <p>Mode de paiement</p>
                        <select name="modePaiement">
                            <?php
                                foreach ($params['modePaiement'] as $Mpd) {
                                    echo '<option value="'.$Mpd->getId().'">'.$Mpd->getLibelle().'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <p>Prix Total HTC : <span><?php echo $total; ?> €</span></p>
                    <p>Prix Livraison : <span><?php echo $prixLivraison; ?> €</span></p>
                    <p>Prix Total TTC : <?php echo $prixLivraison + ($total*120/100); ?> €</p>
                    <input type="submit" name="PasserCommande" value="Passer la commande">
                </div>
            </form>
        </div>
    </div>

    <?php FooterController::readAll($params); ?>

</body>
</html>