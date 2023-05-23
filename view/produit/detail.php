<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        <title>Detail</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
        <link rel="stylesheet" href="CSS/Produit_CSS.css">
        <link rel="stylesheet" href="CSS/Header_Footer.css">
    </head>
<body>
    <?php NavBarreController::readAll($params); ?>

    <div id="titre">
        <?php echo '<h1>'.$params['produit']->getLibelle().'</h1>'; ?>
        <div id="allDescriptionProduit">
            <div id="divImg">
                <?php 
                    echo '<img src="'.$params['produit']->getPathPhoto().'" alt="TV '.$params['produit']->getLibelle().'">'; 
                    echo '</div>';

                    echo '<div id="description">';
                    if (isset($params['listProduitsParModel']) && !empty($params['listProduitsParModel'])) {
                        echo '<div id="tailleEcran">';
                        echo '<h3>Taille d\'écran</h3>';

                        echo '<div>';
                        foreach ($params['listProduitsParModel'] as $produitsParModel) {
                            echo '<a href="produit/detail/'.$produitsParModel->getId().'/"><input type="button" value="'.$produitsParModel->getTaille()->getLibelle().'"></a>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
                <?php
                    echo '<div><h3>Description : </h3>';
                    echo '<p>'.$params['produit']->getDescription().'</p>';
                    echo '</div>';
                ?>
            </div>

            <div id="prix">
                <?php
                    echo '<p>'.$params['produit']->getPrixVenteUHT().'€</p>';
                    if ($params['produit']->getQteEnStock() != 0) {
                        echo '<p id="enStock">En stock</p>';
                    }
                    else{
                        echo '<p id="ruptureStock">Rupture de stock</p>';
                    }
                ?>
                
                
                
                <!-- Button Ajouter au panier  -->
                    <form action="panier/ajout/" method="post">
                        <select name="qte">
                            <?php
                            // générer les options
                            for ($i = 1; $i <= $params['produit']->getQteEnStock(); $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            
                            ?>
                        </select>
                        <?php echo '<input type="hidden" name="idProduit" value='.$params['produit']->getId().'>';?>
                        <input id="btAjoutPanier" type="submit" value="Ajouter au panier">
                    </form>
                <!-- fin button -->
            </div>
        </div>
    </div>
    <div id="divTableau">
        <h4>Tableau de fiche technique</h4>
        <!-- Tableau -->
        <table>
            <tbody>
                <tr>
                    <td class="titre">Désignation</td>
                    <td class="titre"><?php echo $params['produit']->getLibelle();?></td>
                </tr>
                <tr>
                    <td>Marque</td>
                    <td class="titre"><?php echo $params['produit']->getMarque()->getLibelle();?></td>
                </tr>
                <tr>
                    <td>Modéle</td>
                    <td class="titre"><?php echo $params['produit']->getModel()->getLibelle();?></td>
                </tr>
                <tr>
                    <td>Type d'écran</td>
                    <td class="titre"><?php echo $params['produit']->getType()->getLibelle();?></td>
                </tr>
                <tr>
                    <td>Taille de l'écran</td>
                    <td class="titre"><?php echo $params['produit']->getTaille()->getLibelle();?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <?php FooterController::readAll($params); ?>
</body>
</html>