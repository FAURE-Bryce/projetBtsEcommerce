<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Taille</title>
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

                echo '<form id="idForm" action="admin/updateTaille/'.$params['taille']->getId().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id : <?php echo $params['taille']->getId(); ?></p>
                </div>
                <div>
                    <p>Libelle :</p>
                    <input type="number" min="0" name= "libelle" value="<?php echo $params['taille']->getLibelle(); ?>">
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formTaille" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>