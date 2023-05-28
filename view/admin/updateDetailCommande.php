<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Detail-Commande</title>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Admin/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Admin/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">  <!-- à refaire sans Bootstrap -->
    </head>
    <body>
        <?php NavBarreController::readAdminAll($params); ?>
        <div id="all_admin_page">
            <?php 
                if (isset($params['updated']) && $params['updated'] == 2) {
                    echo '<div id="erreur">';
                    echo '<p>Un problème est survenu pendant l\'update</p>';
                    echo '</div>';
                }

                echo '<form id="idForm" action="admin/updateDetailCommande/'.$params['detailCommande']->getIdProduit().'/'.$params['detailCommande']->getIdCommande().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id Commande : <?php echo $params['detailCommande']->getIdCommande(); ?></p>
                </div>
                <div>
                    <p id="emailId">Id Produit : <?php echo $params['detailCommande']->getIdProduit(); ?></p>
                </div>
                <div>
                    <p>Qte :</p>
                    <input type="number" min="0" name="qte" value="<?php echo $params['detailCommande']->getQte(); ?>">
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formDetailCommande" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>