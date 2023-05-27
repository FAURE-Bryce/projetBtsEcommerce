<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Detail-User</title>
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
                if (isset($params['updated']) && $params['updated'] == false) {
                    echo '<div id="erreur">';
                    echo '<p>Un problème est survenu pendant l\'update</p>';
                    echo '</div>';
                }

                echo '<form id="idForm" action="admin/updateUser/'.$params['user']->getId().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id : <?php echo $params['user']->getId(); ?></p>
                </div>
                <div>
                    <p>Nom client : </p>
                    <input type="text" name="nom" value="<?php echo $params['user']->getNom(); ?>">
                </div>
                <div>
                    <p>Prenom client : </p>
                    <input type="text" name="prenom" value="<?php echo $params['user']->getPrenom(); ?>">
                </div>
                <div>
                    <p>DateDeNaissance client : </p>
                    <input type="date" name="dateDeNaissance" value="<?php echo $params['user']->getDateDeNaissance(); ?>">
                </div>
                <div>
                    <p>Numero de telephone du client : </p>
                    <input type="text" name="numeroTelephone" value="<?php echo $params['user']->getNumeroTelephone(); ?>">
                </div>
                <div>
                    <p>Adresse client : </p>
                    <input type="text" name="adresse" value="<?php echo $params['user']->getAdresse(); ?>">
                </div>
                <div>
                    <p>Ville client : </p>
                    <input type="text" name="ville" value="<?php echo $params['user']->getVille(); ?>">
                </div>
                <div>
                    <p>CodePostal client : </p>
                    <input type="text" name="codePostal" value="<?php echo $params['user']->GetCodePostal(); ?>">
                </div>
                <div>
                    <p id="emailId">Email client : <?php echo $params['user']->getEmail(); ?></p>
                </div>
                <div>
                    <p>Role client : </p>
                    <select name="idRole" id="idRole">
                    <?php
                        foreach ($params['listeRole'] as $role) {
                            if ($role->getId() == $params['user']->getRole()->getId()) {
                                echo '<option value="'.$role->getId().'" selected>'.$role->getLibelle().'</option>';
                            }
                            else{
                                echo '<option value="'.$role->getId().'">'.$role->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formUser" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>