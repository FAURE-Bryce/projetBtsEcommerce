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
                if (isset($params['updated']) && !empty($params['updated']) && $params['updated'] == false) {
                    echo '<div id="commandeOk">';
                    echo '<p>Un problème est survenu pendant la création du produit</p>';
                    echo '</div>';
                }
            ?>
            <form id="idForm" action="admin/addProduit/" method="post">
                <div>
                    <p>Model de produit :</p>
                    <select name="idModel" id="idModel">
                    <?php
                        foreach ($params['listeModel'] as $model) {
                            echo '<option value="'.$model->getId().'">'.$model->getLibelle().'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Libelle produit :</p>
                    <input type="text" name="libelle">
                </div>
                <div>
                    <p>Resume produit :</p>
                    <input type="text" name="resume">
                </div>
                <div>
                    <p>Description produit :</p>
                    <input type="text" name="description">
                </div>
                <div>
                    <p>Chemin de fichier de la photo du produit :</p>
                    <input type="text" name="patchPhoto">
                </div>
                <div>
                    <p>Qte en stock produit :</p>
                    <input type="text" name="qteEnStock">
                </div>
                <div>
                    <p>Prix de vente UHT du produit :</p>
                    <input type="text" name="prixVenteUht">
                </div>
                <div>
                    <p>Marque du produit :</p>
                    <select name="idMarque" id="idMarque">
                    <?php
                        foreach ($params['listeMarque'] as $marque) {
                            echo '<option value="'.$marque->getId().'">'.$marque->getLibelle().'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Taille du produit :</p>
                    <select name="idTaille" id="idTaille">
                    <?php
                        foreach ($params['listeTaille'] as $taille) {
                            echo '<option value="'.$taille->getId().'">'.$taille->getLibelle().'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>Type du produit :</p>
                    <select name="idType" id="idType">
                    <?php
                        foreach ($params['listeType'] as $typeEcran) {
                            echo '<option value="'.$typeEcran->getId().'">'.$typeEcran->getLibelle().'</option>';
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