<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Detail-Produit</title>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Admin/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Admin/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
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

                echo '<form id="idForm" action="admin/updateProduit/'.$params['produit']->getId().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id : <?php echo $params['produit']->getId(); ?></p>
                </div>
                <div>
                    <p>Model de produit :</p>
                    
                    <select name="idModel" id="idModel">
                    <?php
                        foreach ($params['listeModel'] as $model) {
                            if ($model->getId() == $params['produit']->getModel()->getId()) {
                                echo '<option value="'.$model->getId().'" selected>'.$model->getLibelle().'</option>';
                            }
                            else{
                                echo '<option value="'.$model->getId().'">'.$model->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Libelle produit :</p>
                    <input type="text" name="libelle" value="<?php echo $params['produit']->getLibelle(); ?>">
                </div>
                <div>
                    <p>Resume produit :</p>
                    <input type="text" name="resume" value="<?php echo $params['produit']->getResume(); ?>">
                </div>
                <div>
                    <p>Description produit :</p>
                    <input type="text" name="description" value="<?php echo $params['produit']->getDescription(); ?>">
                </div>
                <div>
                    <p>Chemin de fichier de la photo du produit :</p>
                    <input type="text" name="patchPhoto" value="<?php echo $params['produit']->getPathPhoto(); ?>">
                </div>
                <div>
                    <p>Qte en stock produit :</p>
                    <input type="number" min="0" name="qteEnStock" value="<?php echo $params['produit']->getQteEnStock(); ?>">
                </div>
                <div>
                    <p>Prix de vente UHT du produit :</p>
                    <input type="number" step="0.01" min="1" name="prixVenteUht" value="<?php echo $params['produit']->getPrixVenteUht(); ?>">
                </div>
                <div>
                    <p>Marque du produit :</p>
                    <select name="idMarque" id="idMarque">
                    <?php
                        foreach ($params['listeMarque'] as $marque) {
                            if ($marque->getId() == $params['produit']->getMarque()->getId()) {
                                echo '<option value="'.$marque->getId().'" selected>'.$marque->getLibelle().'</option>';
                            }
                            else{
                                echo '<option value="'.$marque->getId().'">'.$marque->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Taille du produit :</p>
                    <select name="idTaille" id="idTaille">
                    <?php
                        foreach ($params['listeTaille'] as $taille) {
                            if ($taille->getId() == $params['produit']->getTaille()->getId()) {
                                echo '<option value="'.$taille->getId().'" selected>'.$taille->getLibelle().'</option>';
                            }
                            else{
                                echo '<option value="'.$taille->getId().'">'.$taille->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Type du produit :</p>
                    <select name="idType" id="idType">
                    <?php
                        foreach ($params['listeType'] as $typeEcran) {
                            if ($typeEcran->getId() == $params['produit']->getType()->getId()) {
                                echo '<option value="'.$typeEcran->getId().'" selected>'.$typeEcran->getLibelle().'</option>';
                            }
                            else{
                                echo '<option value="'.$typeEcran->getId().'">'.$typeEcran->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formModification" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>