<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Marque</title>
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

                echo '<form id="idForm" action="admin/updateMarque/'.$params['marque']->getId().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id : <?php echo $params['marque']->getId(); ?></p>
                </div>
                <div>
                    <p>Libelle :</p>
                    <input type="text" name= "libelle" value="<?php echo $params['marque']->getLibelle(); ?>">
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formMarque" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>