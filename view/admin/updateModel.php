<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Model</title>
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

                echo '<form id="idForm" action="admin/updateModel/'.$params['model']->getId().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id : <?php echo $params['model']->getId(); ?></p>
                </div>
                <div>
                    <p>Libelle :</p>
                    <input type="text" name= "libelle" value="<?php echo $params['model']->getLibelle(); ?>">
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formModel" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>