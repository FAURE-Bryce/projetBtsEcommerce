<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Add-Role</title>
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
                if (isset($params['add']) && !empty($params['add']) && $params['add'] == 2) {
                    echo '<div id="erreur">';
                    echo '<p>Un problème est survenu pendant la création du role</p>';
                    echo '</div>';
                }
            ?>
            <form id="idForm" action="admin/addRole/" method="post">
                <div>
                    <p>Libelle role :</p>
                    <input type="text" name="libelle" <?php if (isset($params['libelle']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['libelle'].'"';}?>>
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formRole" value="Ajouter">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>