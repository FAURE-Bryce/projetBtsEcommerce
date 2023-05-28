<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Detail-Produit</title>
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
                if (isset($params['add']) && !empty($params['add']) && $params['add'] == 2) {
                    echo '<div id="erreur">';
                    echo '<p>Un problème est survenu pendant la création du produit</p>';
                    echo '</div>';
                }
            ?>
            <form id="idForm" action="admin/addProduit/" method="post">
                <div>
                    <p>Model de produit :</p>
                    <select name="idModel" id="idModel">
                    <?php
                        if (isset($params['idModel']) && isset($params['add']) && $params['add'] == 2) {
                            foreach ($params['listeModel'] as $model) {
                                if ($model->getId() == $params['idModel']) {
                                    echo '<option value="'.$model->getId().'" selected>'.$model->getLibelle().'</option>';
                                }
                                else{
                                    echo '<option value="'.$model->getId().'">'.$model->getLibelle().'</option>';
                                }
                            }
                        }
                        else {
                            foreach ($params['listeModel'] as $model) {
                                echo '<option value="'.$model->getId().'">'.$model->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Libelle produit :</p>
                    <input type="text" name="libelle" <?php if (isset($params['libelle']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['libelle'].'"';}?>>
                </div>
                <div>
                    <p>Resume produit :</p>
                    <input type="text" name="resume" <?php if (isset($params['resume']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['resume'].'"';}?>>
                </div>
                <div>
                    <p>Description produit :</p>
                    <input type="text" name="description" <?php if (isset($params['description']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['description'].'"';}?>>
                </div>
                <div>
                    <p>Chemin de fichier de la photo du produit :</p>
                    <input type="text" name="patchPhoto" <?php if (isset($params['patchPhoto']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['patchPhoto'].'"';}?>>
                </div>
                <div>
                    <p>Qte en stock produit :</p>
                    <input type="number" min="0" name="qteEnStock" <?php if (isset($params['qteEnStock']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['qteEnStock'].'"';}?>>
                </div>
                <div>
                    <p>Prix de vente UHT du produit :</p>
                    <input type="number" step="0.01" min="1" name="prixVenteUht" <?php if (isset($params['prixVenteUht']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['prixVenteUht'].'"';}?>>
                </div>
                <div>
                    <p>Marque du produit :</p>
                    <select name="idMarque" id="idMarque">
                    <?php
                        if (isset($params['idMarque']) && isset($params['add']) && $params['add'] == 2) {
                            foreach ($params['listeMarque'] as $marque) {
                                if ($marque->getId() == $params['idMarque']) {
                                    echo '<option value="'.$marque->getId().'" selected>'.$marque->getLibelle().'</option>';
                                }
                                else{
                                    echo '<option value="'.$marque->getId().'">'.$marque->getLibelle().'</option>';
                                }
                            }
                        }
                        else {
                            foreach ($params['listeMarque'] as $marque) {
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
                        if (isset($params['idTaille']) && isset($params['add']) && $params['add'] == 2) {
                            foreach ($params['listeTaille'] as $taille) {
                                if ($taille->getId() == $params['idTaille']) {
                                    echo '<option value="'.$taille->getId().'" selected>'.$taille->getLibelle().'</option>';
                                }
                                else{
                                    echo '<option value="'.$taille->getId().'">'.$taille->getLibelle().'</option>';
                                }
                            }
                        }
                        else {
                            foreach ($params['listeTaille'] as $taille) {
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
                        if (isset($params['idType']) && isset($params['add']) && $params['add'] == 2) {
                            foreach ($params['listeType'] as $typeEcran) {
                                if ($typeEcran->getId() == $params['idType']) {
                                    echo '<option value="'.$typeEcran->getId().'" selected>'.$typeEcran->getLibelle().'</option>';
                                }
                                else{
                                    echo '<option value="'.$typeEcran->getId().'">'.$typeEcran->getLibelle().'</option>';
                                }
                            }
                        }
                        else {
                            foreach ($params['listeType'] as $typeEcran) {
                                echo '<option value="'.$typeEcran->getId().'">'.$typeEcran->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formAdd" value="Ajouter">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>